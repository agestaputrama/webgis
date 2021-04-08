<html>
    <head>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        />
        <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
        <script src="https://api.windy.com/assets/map-forecast/libBoot.js"></script>
        <style>
            #windy {
                width: 100%;
                height: 650px;
            }
        </style>
    </head>
    <body>
        <div id="windy"></div>
        <script src="script.js"></script>
    </body>
    <script>
        const options = {
    key: 'PsLAtXpsPTZexBwUkO7Mx5I', // REPLACE WITH YOUR KEY !!!
    lat: -6.903273,
    lon: 107.5731165,
    zoom: 9,
};

windyInit(options, windyAPI => {
    const { picker, utils, broadcast } = windyAPI;

    picker.on('pickerOpened', latLon => {
        // picker has been opened at latLon coords
        console.log(latLon);

        const { lat, lon, values, overlay } = picker.getParams();
        // -> 48.4, 14.3, [ U,V, ], 'wind'
        console.log(lat, lon, values, overlay);

        const windObject = utils.wind2obj(values);
        console.log(windObject);
    });

    picker.on('pickerMoved', latLon => {
        // picker was dragged by user to latLon coords
        console.log(latLon);
    });

    picker.on('pickerClosed', () => {
        // picker was closed
    });

    // Wait since wather is rendered
    broadcast.once('redrawFinished', () => {
        picker.open({ lat: -6.903273, lon: 107.5731165 });
        // Opening of a picker (async)
    });
});
    </script>
</html>