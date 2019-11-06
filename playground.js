/*
Songle api 必要
*/
var accessToken = "YOUR_SONGLE_ACCESSTOKEN";
var secretToken = "YOUR_SONGLE_SECRETTOKEN";

var dougaid;
var obnizid;
var mediaURL = "https://www.youtube.com/watch?v=" + dougaid;

var led;
var blink = false;
var obniz = new Obniz(obnizid);
console.log(obnizid);

function onRadioButtonChange() {
    var radios = document.getElementsByName("answer");
    if (radios[0].checked) {
        blink = false;
    } else {
        blink = true;
    }
}


obniz.onconnect = async function () {
    led = obniz.wired("WS2811", {
        gnd: 0,
        vcc: 1,
        din: 2
    });
}
var red, green, blue;

function changeColor(led) {
    if (led) {
        led.rgb(red, green, blue);
    }
}

function hexFromRGB(r, g, b) {
    var hex = [
      r.toString(16),
      g.toString(16),
      b.toString(16)
  ];
    jQuery.each(hex, function (nr, val) {
        if (val.length === 1) {
            hex[nr] = "0" + val;
        }
    });
    return hex.join('').toUpperCase();
}

function refreshSwatch() {
    red = jQuery('#colorpicker-red').slider('value');
    green = jQuery('#colorpicker-green').slider('value');
    blue = jQuery('#colorpicker-blue').slider('value');
    hex = hexFromRGB(red, green, blue);
    jQuery('#colorpicker-swatch').css('background-color', '#' + hex);
    changeColor(led);
}

jQuery(function () {
    jQuery('#colorpicker-red, #colorpicker-green, #colorpicker-blue').slider({
        orientation: 'horizontal',
        range: 'min',
        max: 255,
        value: 0,
        slide: refreshSwatch,
        change: refreshSwatch
    });
    jQuery('#colorpicker-red').slider('value', 0);
    jQuery('#colorpicker-green').slider('value', 0);
    jQuery('#colorpicker-blue').slider('value', 0);
});

self.onSongleAPIReady =
    function (Songle) {
        var player =
            new Songle.Player({
                accessToken: accessToken,
                secretToken: secretToken,
                mediaElement: "#songle"
            });

        player.addPlugin(new Songle.Plugin.Beat());
        player.addPlugin(new Songle.Plugin.Chord());
        player.addPlugin(new Songle.Plugin.Chorus());
        player.addPlugin(new Songle.Plugin.Melody({
            offset: -100,
        }));

        player.useMedia(mediaURL);
        console.log(player.musicMap);
        player.on("melodyEnter",
            function (ev) {
                //console.log(ev.data.melody);
            });

        player.on("beatPlay",
            function (ev) {
                var beatElement =
                    document.querySelector(".beat");

                var beatInfo1Element =
                    document.querySelector(".beat .info1");

                var beatInfo2Element =
                    document.querySelector(".beat .info2");

                led.rgb(red, green, blue);

                if (blink) {
                    obniz.wait(80);
                    led.rgb(0, 0, 0);
                }

                beatElement.className = "beat beat-" + ev.data.beat.position;
                beatInfo1Element.textContent = ev.data.beat.position;
                beatInfo2Element.textContent = ev.data.beat.count;
            }, {
                offset: -50
            });

        player.on("chordEnter",
            function (ev) {
                var chordNameElement =
                    document.querySelector(".chord .name");

                chordNameElement.textContent = ev.data.chord.name;
            });

        player.on("chorusSectionEnter",
            function (ev) {

            });

        player.on("chorusSectionLeave",
            function (ev) {

            });

        var playButton =
            document.querySelector("button.play");

        var stopButton =
            document.querySelector("button.stop");

        playButton.addEventListener("click",
            function () {
                player.play();
            });

        stopButton.addEventListener("click",
            function () {
                player.stop();
            });

        setInterval(
            function () {
                if (player.isPlaying) {
                    var second = parseInt(player.position / 1000 % 60);
                    var minute = parseInt(player.position / 1000 / 60);
                }
            }, 1000);
    }
