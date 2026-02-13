<?php
function am_portfolio_page() {
    global $wpdb;

    $table = $wpdb->prefix . 'portfolio';

    // SAVE DATA
    if (isset($_POST['save_portfolio'])) {

        $title = sanitize_text_field($_POST['title']);
        $image = esc_url_raw($_POST['image']);

        $wpdb->insert(
            $table,
            [
                'title' => $title,
                'image' => $image
            ],
            [
                '%s',
                '%s'
            ]
        );

        echo "<div style='color:green;'>Saved Successfully</div>";
    }

    $items = $wpdb->get_results("SELECT * FROM $table");

    echo "<h1>Portfolio</h1>";

    echo '<form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="image" placeholder="Image URL">
        <button type="submit" name="save_portfolio" value="1">Save</button>
    </form><hr>';

    echo "<table border='1' cellpadding='8'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
            </tr>";
    foreach ($items as $item) {
        echo "<tr>
                <td>{$item->id}</td>
                <td>{$item->title}</td>
                <td><img src='{$item->image}' width='100'></td>
              </tr>";
    }

    echo "</table>";
}
