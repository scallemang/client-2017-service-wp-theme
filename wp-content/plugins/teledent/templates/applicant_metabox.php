<table>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_name">Establishment/Name</label>
        </th>
        <td>
            <input type="text" id="applicant_name" name="applicant_name" value="<?php echo @get_post_meta($post->ID, 'applicant_name', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_address">Street Address</label>
        </th>
        <td>
            <input type="text" id="applicant_address" name="applicant_address" value="<?php echo @get_post_meta($post->ID, 'applicant_address', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_city">City</label>
        </th>
        <td>
            <input type="text" id="applicant_city" name="applicant_city" value="<?php echo @get_post_meta($post->ID, 'applicant_city', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_state">State</label>
        </th>
        <td>
            <input type="text" id="applicant_state" name="applicant_state" value="<?php echo @get_post_meta($post->ID, 'applicant_state', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_postal">Postal/Zip</label>
        </th>
        <td>
            <input type="text" id="applicant_postal" name="applicant_postal" value="<?php echo @get_post_meta($post->ID, 'applicant_postal', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_country">Country</label>
        </th>
        <td>
            <input type="text" id="applicant_country" name="applicant_country" value="<?php echo @get_post_meta($post->ID, 'applicant_country', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_phone">Phone</label>
        </th>
        <td>
            <input type="text" id="applicant_phone" name="applicant_phone" value="<?php echo @get_post_meta($post->ID, 'applicant_phone', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_url">URL</label>
        </th>
        <td>
            <input type="text" id="applicant_url" name="applicant_url" value="<?php echo @get_post_meta($post->ID, 'applicant_url', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_email">Email</label>
        </th>
        <td>
            <input type="text" id="applicant_email" name="applicant_email" value="<?php echo @get_post_meta($post->ID, 'applicant_email', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_lat">Latitude</label>
        </th>
        <td>
            <input type="text" id="applicant_lat" name="applicant_lat" value="<?php echo @get_post_meta($post->ID, 'applicant_lat', true); ?>" />
        </td>
    </tr>

    <tr valign="top">
        <th class="metabox_label_column">
            <label for="applicant_lng">Longitude</label>
        </th>
        <td>
            <input type="text" id="applicant_lng" name="applicant_lng" value="<?php echo @get_post_meta($post->ID, 'applicant_lng', true); ?>" />
        </td>
    </tr>

</table>
