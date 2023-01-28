<div id="dtp_legend"  class="no-show">
    <h2>
        Легенда
    </h2>
    <h4>
        Карта с рейтингом ДТП
    </h4>
    <div class="font-weight d-flex justify-content-between" >
        <table style="font-size:1.5em">
            <tr>
                <td class="" style="width: 30px;">
                    0
                </td>
                <td style="background-color: #deffff; height:10px; width:40px; "></td>
            </tr>
            <tr>
                <td>
                    1
                </td>
                <td style="background-color: #c1e7eb;"></td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td style="background-color: #a5d0d7;"></td>
            </tr>
            <tr>
                <td>
                    3
                </td>
                <td style="background-color: #8ab9c4;"></td>
            </tr>
            <tr>
                <td>
                    4
                </td>
                <td style="background-color: #70a3b2;"></td>
            </tr>
            <tr>
                <td>
                    5
                </td>
                <td style="background-color: #578ca0;"></td>
            </tr>
            <tr>
                <td>
                    6
                </td>
                <td style="background-color: #3e768f;"></td>
            </tr>
            <tr>
                <td>
                    7
                </td>
                <td style="background-color: #24617e;"></td>
            </tr>
            <tr>
                <td>
                    8
                </td>
                <td style="background-color: #004c6d;"></td>
            </tr>
            <tr>
                <td>
                    9
                </td>
                <td style="background-color: #002c3f;"></td>
            </tr>
        </table>

        <div class="text-center bolder" style="padding:15px; height:100%; display:flex; flex-direction: column;" >

                <div style="background-color: #e7e7e7; margin-bottom:10px; padding: 13px;">
                    <div style="font-size: 1.3em; font-weight: bold;">
                        наезд на пешехода
                    </div>
                    <div>
                        <img src="{{ asset('legends/pedestrian.svg') }}" height="100px" style="color: red;"/>
                    </div>
                </div>
                <div style="background-color: #e7e7e7;">
                    <div style="font-size: 1.3em; font-weight: bold;">
                        место ДТП
                    </div>
                    <div>
                        <img src="{{ asset('legends/accident.svg') }}" height="100px" style="color: red;"/>
                    </div>
                </div>
        </div>
    </div>
</div>