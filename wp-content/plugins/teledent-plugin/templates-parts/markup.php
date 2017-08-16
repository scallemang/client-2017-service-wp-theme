<div id="productFinder"
    class="loadState">

    <!-- Location Search Bar & Filters -->
    <div id="t_filters">

        <fieldset>
            <span class="alert alert--hide">No results, please be more specific.</span>
            <label>
                <span>Location:</span>
                <input type="text"
                    id="t_map_seach_location"
                    name="t_map_seach_location"
                    placeholder="Type your location here">
            </label>
            <a id="t_map_search_button"
                class="button">Search</a>
            <?php if(isset($_SERVER['HTTPS'])) { ?>
                <a id="t_map_search_my_location"
                    class="button button--alt">Use My Location</a>
            <?php } ?>
        </fieldset>

        <!-- <fieldset>
            <label>
                <span>Filters:</span>
                <ul id="t_filterList">
                    <li ng-repeat="l in arrFromLocations">
                        {{l.type}}
                    </li>
                </ul>
        </fieldset> -->

    </div>

    <!-- Relatively Positioned Container -->
    <div id="t_locations_container">
        <div id="t_map">
            <!-- Populate Map -->
        </div>
        <div id="t_info_cards">
            <!-- Populate Info Cards -->
        </div>
        <div id="t_cover_up" class="do">
            <!-- Wait State/Loader -->
        </div>
    </div>

    <!-- Hidden Fields -->
    <input id="t_lcbo_term"
        type="hidden"
        value="">

    <input id="t_hq_address"
        type="hidden"
        value="">

    <input id="t_hq_lat"
        type="hidden"
        value="">

    <input id="t_hq_lng"
        type="hidden"
        value="">

    <input id="t_hq_hours"
        type="hidden"
        value="">

    <input id="t_hq_phone"
        type="hidden"
        value="">

    <input id="t_brewer"
        type="hidden"
        value="">

    <input id="t_distances"
        type="hidden"
        value="[]">

</div>