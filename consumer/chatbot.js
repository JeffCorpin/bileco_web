document.addEventListener("DOMContentLoaded", function () {
    const chatbotContainer = document.getElementById("chatbotContainer");
    const chatbotToggle = document.getElementById("chatbotToggle");
    const closeChatbot = document.getElementById("closeChatbot");
    const chatbotMessages = document.getElementById("chatbotMessages");
    const chatbotInput = document.getElementById("chatbotInput");
    const sendChatbotMessage = document.getElementById("sendChatbotMessage");

    // Show/Hide chatbot
    chatbotToggle.addEventListener("click", function () {
        chatbotContainer.classList.toggle("d-none");
    });

    closeChatbot.addEventListener("click", function () {
        chatbotContainer.classList.add("d-none");
    });

    // Handle sending messages
    sendChatbotMessage.addEventListener("click", function () {
        sendMessage();
    });

    chatbotInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });

    function sendMessage() {
        let userMessage = chatbotInput.value.trim();
        if (userMessage) {
            displayMessage(userMessage, "user");
            chatbotInput.value = "";
            sendMessageToServer(userMessage);
        }
    }

    function displayMessage(message, sender) {
        let messageElement = document.createElement("div");
        messageElement.classList.add("chatbot-message", sender);
        messageElement.innerText = message;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function sendMessageToServer(message) {
        fetch("chatbot.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "message=" + encodeURIComponent(message),
        })
        .then(response => response.json())
        .then(data => {
            displayMessage(data.response, "bot");
        })
        .catch(error => {
            displayMessage("Error: Unable to connect to chatbot.", "bot");
        });
    }
});
