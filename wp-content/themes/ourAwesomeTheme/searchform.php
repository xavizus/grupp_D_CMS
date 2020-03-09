<form class="form form--search" action="" method="post">
    <input type="hidden" name="customSearch" value="1" />
    <fieldset>
        <div>
            <div data-role="rangeslider">
                <input type="hidden" id="values" data-min="50" data-max="55" />
                <p>
                    <label for="noofrooms">Antal rum:</label><br>
                    <input type="text" id="noofrooms" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="noofrooms-range"></div>
            </div>
            <br>
            <div data-role="rangeslider">
                <p>
                    <label for="kvm">Antal kvm:</label><br>
                    <input type="text" id="kvm" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="kvm-range"></div>
            </div>
            <br>
            <div data-role="rangeslider">
                <p>
                    <label for="initialbid">Pris:</label><br>
                    <input type="text" id="initialbid" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="initialbid-range"></div>
            </div>
            <br>
            <input id="search-properties" type="search" placeholder="Egenskaper" name="s">
            <br>
            <input type="search" name="s" class="search__input" placeholder="Sök efter ort" />
            <br><br>
            <button type="submit" class="button button--submit">Submit</button>
        </div>

    </fieldset>
</form>