<form class="form form--search" action="" method="post">
    <input type="hidden" name="customSearch" value="1" />
    <fieldset>
        <div>
            <div data-role="rangeslider">
                <input type="hidden" name="minnoofrooms" id="minnoofrooms" value="10"/>
                <input type="hidden" name="maxnoofrooms" id="maxnoofrooms" value="10"/>
                <p>
                    <label for="noofrooms">Antal rum:</label><br>
                    <input type="text" id="noofrooms" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="noofrooms-range"></div>
            </div>
            <br>
            <div data-role="rangeslider">
                <input type="hidden" name="minkvm" id="minkvm" value="10"/>
                <input type="hidden" name="maxkvm" id="maxkvm" value="10"/>
                <p>
                    <label for="kvm">Antal kvm:</label><br>
                    <input type="text" id="kvm" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="kvm-range"></div>
            </div>
            <br>
            <div data-role="rangeslider">
                <input type="hidden" name="mininitialbid" id="mininitialbid" value="10"/>
                <input type="hidden" name="maxinitialbid" id="maxinitialbid" value="10"/>
                <p>
                    <label for="initialbid">Pris:</label><br>
                    <input type="text" id="initialbid" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="initialbid-range"></div>
            </div>
            <br>
            <input id="search-properties" type="search" name="search-properties" placeholder="Egenskaper">
            <br>
            <input type="search" name="s" placeholder="Sök efter ort" />
            <br><br>
            <button type="submit" class="button button--submit">Submit</button>
        </div>

    </fieldset>
</form>