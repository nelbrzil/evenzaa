// Evenza Knowledge Base
const evenzaKnowledge = {
    general: {
        overview: "Evenza is your go-to platform for discovering, booking, and managing events in your area. From concerts to workshops, seminars to festivals, Evenza connects you with events you love.",
        services: "We provide event schedules, ticketing options, venue details, and reminders. You can explore events by category, location, or date."
    },
    categories: {
        business: {
            name: "Business",
            description: "Events for professionals, leaders, and innovators.",
            events: [
                { title: "Business Innovation Summit", venue: "Grand Luxe Hotel - Grand Ballroom", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Tech Leaders Forum", venue: "Grand Luxe Hotel - Innovation Center", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Corporate Team Building Retreat", venue: "Grand Luxe Hotel - Mountain Resort Wing", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Leadership Summit", venue: "Grand Luxe Hotel - Executive Center", location: "123 Luxury Avenue, Suite 100, City, State 12345" }
            ]
        },
        wedding: {
            name: "Wedding",
            description: "Elegant and luxurious wedding events.",
            events: [
                { title: "Elegant Garden Wedding", venue: "Grand Luxe Hotel - Garden Pavilion", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Luxury Beach Wedding", venue: "Grand Luxe Hotel - Oceanview Terrace", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Spring Wedding Collection", venue: "Grand Luxe Hotel - Grand Ballroom", location: "123 Luxury Avenue, Suite 100, City, State 12345" }
            ]
        },
        socials: {
            name: "Socials",
            description: "Gala dinners, parties, and exclusive events.",
            events: [
                { title: "New Year’s Eve Gala Dinner", venue: "Grand Luxe Hotel - Crystal Ballroom", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Exclusive Members Gala", venue: "Grand Luxe Hotel - VIP Lounge", location: "123 Luxury Avenue, Suite 100, City, State 12345" }
            ]
        },
        workshop: {
            name: "Workshop",
            description: "Skill-building and professional development workshops.",
            events: [
                { title: "Advanced Skills Training", venue: "Grand Luxe Hotel - Training Center", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Professional Development Workshop", venue: "Grand Luxe Hotel - Conference Hall B", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Digital Marketing Masterclass", venue: "Grand Luxe Hotel - Conference Hall A", location: "123 Luxury Avenue, Suite 100, City, State 12345" }
            ]
        },
        premium: {
            name: "Premium",
            description: "Exclusive, high-end events for VIP guests.",
            events: [
                { title: "New Year’s Eve Gala Dinner", venue: "Grand Luxe Hotel - Crystal Ballroom", location: "123 Luxury Avenue, Suite 100, City, State 12345" },
                { title: "Exclusive Members Gala", venue: "Grand Luxe Hotel - VIP Lounge", location: "123 Luxury Avenue, Suite 100, City, State 12345" }
            ]
        }
    },
    reservation: {
        formFields: ["Full Name", "Email Address", "Mobile Number", "Preferred Date", "Event Start Time", "Event End Time", "Select Package (Bronze, Silver, Gold)"],
        paymentMethods: ["Paypal"]
    }
};

// Question matching and response generation
function findEvenzaAnswer(question) {
    const q = question.toLowerCase().trim();

    // Greetings
    if (q.match(/\b(hi|hello|hey|greetings|good morning|good afternoon|good evening)\b/)) {
        return "Hello! I'm your Evenza guide 🤖. I can help you explore events, categories, venues, schedules, and booking info. What would you like to know?";
    }

    // General Evenza info
    if (q.match(/\b(what is evenza|about evenza|information about evenza|overview|services)\b/)) {
        return evenzaKnowledge.general.overview + " " + evenzaKnowledge.general.services;
    }

    // Event Categories
    // Event Categories
    if (q.match(/\b(categories|types of events|events|business|wedding|socials|workshop|premium)\b/)) {
        let response = "Evenza features the following event categories:\n\n";
        for (let key in evenzaKnowledge.categories) {
            const cat = evenzaKnowledge.categories[key];
            response += `📂 ${cat.name}\n`;
            cat.events.forEach(evt => {
                response += `   🎫 ${evt.title}\n`;
            });
            response += "\n";
        }
        return response.trim();
    }


    // Specific Event Details
    for (let key in evenzaKnowledge.categories) {
        const cat = evenzaKnowledge.categories[key];
        for (let evt of cat.events) {
            if (q.includes(evt.title.toLowerCase())) {
                return `📌 Event: ${evt.title}\n🏛 Venue: ${evt.venue}\n📍 Location: ${evt.location}\n📂 Category: ${cat.name}`;
            }
        }
    }

    // Reservation Info
    if (q.match(/\b(reservation|booking|book an event|how to book|reserve)\b/)) {
        let form = evenzaKnowledge.reservation.formFields.map(f => `- ${f}`).join("\n");
        let payment = evenzaKnowledge.reservation.paymentMethods.join(", ");
        return `📝 Reservation / Booking Form:\n${form}\n\n💳 Payment Methods: ${payment}`;
    }

    // Help/Capabilities
    if (q.match(/\b(help|what can you|what do you|assist|capabilities)\b/)) {
        return "I can help you with:\n\n" +
            "📂 Event categories and details\n" +
            "📌 Specific event info\n" +
            "🏛 Venue details\n" +
            "📝 Reservation and booking info\n" +
            "📚 General information about Evenza\n\n" +
            "Just ask me anything related to Evenza!";
    }

    // Default response
    return "I understand you're asking about Evenza. Could you be more specific? You can ask me about:\n\n" +
        "• Event categories (Business, Wedding, Socials, Workshop, Premium)\n" +
        "• Specific events\n" +
        "• Venue information\n" +
        "• Reservation / booking info\n" +
        "• General Evenza info";
}



// The rest of your chat functionality remains the same
const chatFab = document.getElementById('chatFab');
const chatWindow = document.getElementById('chatWindow');
const closeChatBtn = document.getElementById('closeChatBtn');
const clearChatBtn = document.getElementById('clearChatBtn');
const chatBody = document.getElementById('chatBody');
const chatInput = document.getElementById('chatInput');
const chatSendBtn = document.getElementById('chatSendBtn');
const typingIndicator = document.getElementById('typingIndicator');
const placeholder = chatBody.querySelector('.chat-placeholder');

chatFab.addEventListener('click', () => {
    chatWindow.classList.add('active');
    chatInput.focus();
});

closeChatBtn.addEventListener('click', () => {
    chatWindow.classList.remove('active');
});

clearChatBtn.addEventListener('click', () => {
    const messages = chatBody.querySelectorAll('.chat-message');
    messages.forEach(msg => msg.remove());
    placeholder.style.display = 'block';
    typingIndicator.classList.remove('active');
});

function sendMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    if (placeholder) placeholder.style.display = 'none';

    const userMessage = document.createElement('div');
    userMessage.className = 'chat-message user';
    userMessage.textContent = message;
    chatBody.appendChild(userMessage);
    chatInput.value = '';
    chatBody.scrollTop = chatBody.scrollHeight;

    typingIndicator.classList.add('active');
    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(() => {
        typingIndicator.classList.remove('active');
        const botMessage = document.createElement('div');
        botMessage.className = 'chat-message bot';
        const response = findEvenzaAnswer(message);
        botMessage.textContent = response;
        chatBody.appendChild(botMessage);
        chatBody.scrollTop = chatBody.scrollHeight;
    }, 800 + Math.random() * 700);
}

chatSendBtn.addEventListener('click', sendMessage);
chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
});
