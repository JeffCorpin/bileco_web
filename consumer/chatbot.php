<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userMessage = trim($_POST["message"]);

    // Simple predefined responses
    $responses = [
        "hi" => "Hello! How can I assist you?",
        "how are you" => "I'm just a chatbot of BILECO, but I'm here to help!",
        "billing" => "You can check your billing details in the dashboard.",
        "account" => "To update your account, go to the profile page.",
        "bye" => "Goodbye! Have a great day!",
        "thank you" => "You're welcome! Let me know if you need any help.",
        "where is bileco office located" => "BILECO office is located in Brgy Caray-Caray Naval, Biliran.",
        "where is bileco located" => "BILECO office is located in Brgy Caray-Caray Naval, Biliran.",
        "who is the general manager" => "The General Manager in BILECO is Engr. Gerardo N. Oledan"
    ];

    $userMessageLower = strtolower($userMessage);
    $botResponse = "I'm not sure how to respond to that. Try asking something else.";

    foreach ($responses as $key => $response) {
        if (strpos($userMessageLower, $key) !== false) {
            $botResponse = $response;
            break;
        }
    }

    echo json_encode(["response" => $botResponse]);
}
?>
