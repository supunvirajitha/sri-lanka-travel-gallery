<?php

if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

$places = [

    "sigiriya" => [
        "name" => "Sigiriya Rock Fortress",
        "location" => "Dambulla, Sri Lanka",
        "category" => "Heritage",
        "image" => "assets/images/sigiriya.jpg",

        "short" => "A world-famous ancient rock fortress with amazing views and history.",
        "description" => "Sigiriya is one of Sri Lanka's most iconic landmarks. It is an ancient rock fortress surrounded by beautiful gardens, water features, frescoes, and historical ruins. The climb to the top gives visitors a breathtaking view of the surrounding landscape.",
        "best_time" => "January to April",
        "activities" => ["Rock climbing", "Photography", "History tour", "Nature walk"]
    ],

    "ella" => [
        "name" => "Ella",
        "location" => "Badulla, Sri Lanka",
        "category" => "Mountain",
        "image" => "assets/images/ella.jpeg",

        "short" => "A peaceful mountain town with waterfalls, tea estates, and scenic train rides.",
        "description" => "Ella is a beautiful hill-country destination famous for its cool weather, tea plantations, waterfalls, and stunning viewpoints. It is perfect for hiking, relaxing, and enjoying nature.",
        "best_time" => "December to March",
        "activities" => ["Hiking", "Train ride", "Waterfall visit", "Tea estate tour"]
    ],

    "galle" => [
        "name" => "Galle Fort",
        "location" => "Galle, Sri Lanka",
        "category" => "Coastal",
        "image" => "assets/images/galle.webp",

        "short" => "A historical coastal city with Dutch architecture and ocean views.",
        "description" => "Galle Fort is a UNESCO World Heritage site located on the southern coast of Sri Lanka. It is known for its colonial buildings, cafes, museums, boutique shops, and beautiful sea views.",
        "best_time" => "December to April",
        "activities" => ["City walk", "Photography", "Cafe visit", "Sunset watching"]
    ],

    "kandy" => [
        "name" => "Kandy",
        "location" => "Central Province, Sri Lanka",
        "category" => "Culture",
        "image" => "assets/images/kandy.jpg",

        "short" => "A cultural city surrounded by hills and home to the Temple of the Tooth.",
        "description" => "Kandy is one of the most important cultural cities in Sri Lanka. It is famous for the Temple of the Sacred Tooth Relic, Kandy Lake, botanical gardens, and traditional dance performances.",
        "best_time" => "January to April",
        "activities" => ["Temple visit", "Lake walk", "Cultural show", "Garden visit"]
    ],

    "mirissa" => [
        "name" => "Mirissa Beach",
        "location" => "Matara, Sri Lanka",
        "category" => "Beach",
        "image" => "assets/images/mirissa.jpg",

        "short" => "A relaxing beach destination famous for whale watching and sunsets.",
        "description" => "Mirissa is a beautiful beach town in southern Sri Lanka. It is popular for whale watching, surfing, seafood restaurants, and peaceful beach views.",
        "best_time" => "November to April",
        "activities" => ["Whale watching", "Surfing", "Beach walk", "Sunset watching"]
    ],

    "nuwara-eliya" => [
        "name" => "Nuwara Eliya",
        "location" => "Central Province, Sri Lanka",
        "category" => "Mountain",
        "image" => "assets/images/nuwara-eliya.jpg",

        "short" => "A cool hill-country city with tea estates, gardens, and misty weather.",
        "description" => "Nuwara Eliya is known as Little England because of its cool climate and colonial-style buildings. It is famous for tea plantations, Gregory Lake, Hakgala Gardens, and beautiful mountain views.",
        "best_time" => "February to April",
        "activities" => ["Tea factory visit", "Boat ride", "Garden visit", "Photography"]
    ],

    "yala" => [
        "name" => "Yala National Park",
        "location" => "Hambantota, Sri Lanka",
        "category" => "Wildlife",
        "image" => "assets/images/yala.webp",

        "short" => "A famous wildlife park where you can see leopards, elephants, and birds.",
        "description" => "Yala National Park is one of the best places in Sri Lanka for wildlife safaris. It is famous for leopards, elephants, crocodiles, deer, and many species of birds.",
        "best_time" => "February to July",
        "activities" => ["Safari", "Wildlife photography", "Bird watching", "Nature tour"]
    ],

    "anuradhapura" => [
        "name" => "Anuradhapura",
        "location" => "North Central Province, Sri Lanka",
        "category" => "Heritage",
        "image" => "assets/images/anuradhapura.jpeg",

        "short" => "An ancient city with temples, stupas, ruins, and sacred places.",
        "description" => "Anuradhapura is an ancient capital of Sri Lanka with many historical and religious sites. It is famous for large stupas, ancient ruins, stone carvings, and sacred Buddhist locations.",
        "best_time" => "May to September",
        "activities" => ["Temple visit", "History tour", "Cycling", "Photography"]
    ]

];

?>
