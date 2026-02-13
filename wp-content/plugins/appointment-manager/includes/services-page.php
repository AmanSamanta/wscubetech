<?php
function am_services_page() {
    global $wpdb;

    if (isset($_POST['save_service'])) {
        $wpdb->insert(
            $wpdb->prefix . 'services',
            [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ]
        );
    }

    $services = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}services");

    echo "<h1>Services</h1>";

    echo '<form method="post">
        <input type="text" name="title" placeholder="Service Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="price" placeholder="Price">
        <button name="save_service">Save</button>
    </form><hr>';

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
            </tr>";

    foreach ($services as $service) {
        echo "<tr>
                <td>{$service->id}</td>
                <td>{$service->title}</td>
                <td>{$service->price}</td>
              </tr>";
    }

    echo "</table>";
}
