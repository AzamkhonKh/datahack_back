
@damas-accident-fill: #ebb600;
@damas-accident-humandamage-fill: #ff0000;
@damas-accident-line: #534000;

#damas-accident-point {
    marker-file: url('symbols/damas/accident.svg');
    marker-line-width: 0.5;
    marker-line-color: @damas-accident-line;
    marker-clip: false;
    marker-width:  20;
    marker-height: 20;
    marker-fill: @damas-accident-fill;
    [type=1] {
        marker-fill: @damas-accident-humandamage-fill;
        marker-file: url('symbols/damas/pedestrian.svg');
    }
    [type=5] {
        marker-fill: @damas-accident-humandamage-fill;
        marker-file: url('symbols/damas/pedestrian.svg');
    }
}
