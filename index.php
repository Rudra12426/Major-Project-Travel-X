
<?php

// ── Configurable site data (swap with DB queries later) ──────
$site = [
    'name'    => 'TravelX',
    'tagline' => 'Discover new destinations, cultures, and experiences',
    'year'    => date('Y'),
];

$destinations = [
    ['name' => 'Paris',    'country' => 'France',  'link' => 'paris.php',   'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsI-Ys7L1wNDYi5sNlXzZihX5ozoMY1AEqEQ&s'],
    ['name' => 'Tokyo',    'country' => 'Japan',   'link' => 'tokyo.php',   'img' => 'tokyo.jpeg'],
    ['name' => 'New York', 'country' => 'USA',     'link' => 'newyork.php', 'img' => 'usa.jpeg'],
    ['name' => 'Rome',     'country' => 'Italy',   'link' => 'rome.php',    'img' => 'rome.jpeg'],
    ['name' => 'Dubai',    'country' => 'UAE',     'link' => 'dubai.php',   'img' => 'uae.jpeg'],
    ['name' => 'Bali',     'country' => 'Indonesia','link'=> 'bali.php',    'img' => 'bali.jpeg'],
];

$transport = [
    ['label' => 'By Air',   'icon' => '✈️', 'img' => 'air.jpeg'],
    ['label' => 'By Train', 'icon' => '🚆', 'img' => 'train.jpeg'],
    ['label' => 'By Bus',   'icon' => '🚌', 'img' => 'bus.jpeg'],
    ['label' => 'By Ship',  'icon' => '🚢', 'img' => 'ship.jpeg'],
];

$foods = [
    ['name' => 'Pizza',       'img' => 'pizza.jpeg'],
    ['name' => 'Sushi',       'img' => 'data:image/jpeg;base64,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'],
    ['name' => 'Indian Food', 'img' => 'food.jpeg'],
    ['name' => 'Samosa',      'img' => 'Samosa.jpeg'],
    ['name' => 'Pasta',       'img' => 'pasta.jpeg'],
    ['name' => 'Ramen',       'img' => 'ramen.jpeg'],
];

$team = [
    ['role' => 'Frontend Developer & UI Designer',    'name' => 'Aditya Singh'],
    ['role' => 'Content Writer & Image Curator',       'name' => 'Rudra Pratap Rai'],
    ['role' => 'JavaScript Developer & Search',        'name' => 'Ankit Kumar Tiwari'],
    ['role' => 'CSS Stylist & Layout Designer',        'name' => 'Ashish Kumar Singh'],
    
];

// ── Simple search filter ─────────────────────────────────────
$search = isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'])) : '';
if ($search !== '') {
    $destinations = array_filter($destinations, fn($d) =>
        stripos($d['name'], $search) !== false ||
        stripos($d['country'], $search) !== false
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title><?= htmlspecialchars($site['name']) ?> – Explore The World</title>

<style>
/* ── Reset & Base ─────────────────────────────────── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Segoe UI',Arial,sans-serif;background:#faf8f4;color:#222}

/* ── NAV ──────────────────────────────────────────── */
nav{
  width:100%;background:linear-gradient(135deg,#8B0000,#FFA500);
  display:flex;justify-content:space-between;align-items:center;
  padding:14px 40px;position:sticky;top:0;z-index:999;
  box-shadow:0 2px 12px rgba(0,0,0,.25);
}
.logo{font-size:1.8rem;font-weight:800;color:#fff;letter-spacing:1px;text-shadow:1px 1px 3px rgba(0,0,0,.4)}
nav ul{display:flex;gap:22px;list-style:none}
nav ul li a{text-decoration:none;color:#fff;font-size:1rem;font-weight:600;padding:6px 10px;border-radius:6px;transition:background .2s}
nav ul li a:hover{background:rgba(255,255,255,.2)}
.menu-btn{display:none;font-size:1.8rem;cursor:pointer;color:#fff;background:none;border:none}

/* ── HERO ─────────────────────────────────────────── */
.hero{
  position:relative;width:100%;height:72vh;
  background:url("https://media2.thrillophilia.com/images/photos/000/171/617/original/1568966645_Taj_Mahal_Sunset.jpg?") center/cover no-repeat;
  display:flex;justify-content:center;align-items:center;color:#fff;text-align:center;
}
.hero::before{content:'';position:absolute;inset:0;background:rgba(0,0,0,.42)}
.hero-content{position:relative;z-index:1;padding:0 20px}
.hero h1{font-size:clamp(2rem,6vw,4rem);font-weight:800;text-shadow:2px 2px 6px rgba(0,0,0,.5)}
.hero p{font-size:1.2rem;margin:12px 0 24px;opacity:.9}

/* ── SEARCH FORM ──────────────────────────────────── */
.search-form{display:flex;gap:10px;justify-content:center;flex-wrap:wrap}
.search-form input{
  padding:12px 22px;border-radius:30px;border:none;font-size:1rem;
  width:280px;outline:none;box-shadow:0 2px 8px rgba(0,0,0,.3);
}
.search-btn{
  background:#ff4b4b;color:#fff;padding:12px 30px;
  border-radius:30px;border:none;cursor:pointer;font-size:1rem;font-weight:700;
  transition:background .2s;box-shadow:0 2px 8px rgba(0,0,0,.3);
}
.search-btn:hover{background:#cc0000}

/* ── SECTIONS ─────────────────────────────────────── */
section{width:90%;max-width:1200px;margin:0 auto;padding:50px 0}
section h2{font-size:2rem;margin-bottom:8px;color:#8B0000}
.section-line{width:60px;height:4px;background:linear-gradient(to right,#8B0000,#FFA500);border-radius:2px;margin-bottom:28px}

/* ── CARD GRID ────────────────────────────────────── */
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:22px}
.card{
  background:#fff;border-radius:14px;overflow:hidden;
  box-shadow:0 4px 14px rgba(0,0,0,.10);transition:transform .25s,box-shadow .25s;
  cursor:pointer;
}
.card:hover{transform:translateY(-6px);box-shadow:0 10px 28px rgba(0,0,0,.16)}
.card img{width:100%;height:170px;object-fit:cover;display:block}
.card-text{padding:14px}
.card-text h3{font-size:1.1rem;font-weight:700;color:#222}
.card-text p{font-size:.87rem;color:#666;margin-top:3px}
.card-text .badge{
  display:inline-block;margin-top:8px;background:#FFA500;color:#fff;
  font-size:.75rem;font-weight:700;padding:3px 10px;border-radius:20px;
}
.card a{text-decoration:none;color:inherit}

/* ── NO RESULTS ───────────────────────────────────── */
.no-results{text-align:center;padding:40px;color:#888;font-size:1.1rem}

/* ── BOOKING BANNER ───────────────────────────────── */
.booking-banner{
  background:linear-gradient(135deg,#8B0000,#FFA500);
  color:#fff;text-align:center;padding:50px 20px;margin-top:20px;
}
.booking-banner h2{font-size:2rem;margin-bottom:10px}
.booking-banner p{opacity:.9;margin-bottom:20px}
.book-btn{
  background:#fff;color:#8B0000;padding:13px 38px;border-radius:30px;
  border:none;font-size:1rem;font-weight:700;cursor:pointer;text-decoration:none;
  display:inline-block;transition:background .2s;
}
.book-btn:hover{background:#ffe0e0}

/* ── FOOTER ───────────────────────────────────────── */
footer{
  background:#1a1a1a;color:#ccc;padding:50px 40px;text-align:center;margin-top:0;
}
footer h3{color:#FFA500;font-size:1.4rem;margin-bottom:6px}
.footer-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px;margin-top:20px}
.team-card{background:#2a2a2a;border-radius:10px;padding:14px;text-align:left}
.team-card strong{display:block;color:#fff;font-size:.95rem}
.team-card span{font-size:.8rem;color:#aaa}
footer a{color:#FFA500;text-decoration:none}
footer .copy{margin-top:30px;font-size:.85rem;opacity:.6}

/* ── RESPONSIVE ───────────────────────────────────── */
@media(max-width:768px){
  nav ul{display:none;flex-direction:column;position:absolute;top:60px;left:0;width:100%;
         background:linear-gradient(135deg,#8B0000,#FFA500);padding:16px 30px}
  nav ul.open{display:flex}
  .menu-btn{display:block}
  nav{padding:14px 20px}
  section{width:95%}
}
</style>
</head>
<body>

<!-- ── NAVIGATION ──────────────────────────────────────── -->
<nav>
  <div class="logo"><?= htmlspecialchars($site['name']) ?></div>
  <button class="menu-btn" onclick="toggleMenu()" aria-label="Menu">☰</button>
  <ul id="menuList">
    <li><a href="index.php">Home</a></li>
    <li><a href="#destinations">Destinations</a></li>
    <li><a href="#transport">Transport</a></li>
    <li><a href="#foods">Foods</a></li>
    <li><a href="booking.php">📋 Book Ticket</a></li>
  </ul>
</nav>

<!-- ── HERO ────────────────────────────────────────────── -->
<div class="hero">
  <div class="hero-content">
    <h1>Explore the World</h1>
    <p><?= htmlspecialchars($site['tagline']) ?></p>
    <form class="search-form" method="GET" action="index.php">
      <input
        type="text"
        name="q"
        placeholder="Search destinations…"
        value="<?= htmlspecialchars($search) ?>"
        aria-label="Search destinations"
      />
      <button class="search-btn" type="submit">🔍 Search</button>
      <?php if ($search): ?>
        <a href="index.php" class="search-btn" style="background:#444;text-decoration:none">✕ Clear</a>
      <?php endif; ?>
    </form>
  </div>
</div>

<!-- ── POPULAR DESTINATIONS ────────────────────────────── -->
<section id="destinations">
  <h2>
    <?= $search
        ? '🔍 Results for "<em>' . htmlspecialchars($search) . '</em>"'
        : 'Popular Destinations'
    ?>
  </h2>
  <div class="section-line"></div>

  <?php if (empty($destinations)): ?>
    <div class="no-results">😞 No destinations found for "<?= htmlspecialchars($search) ?>". <a href="index.php">Clear search</a></div>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($destinations as $d): ?>
        <div class="card">
          <a href="<?= htmlspecialchars($d['link']) ?>">
            <img
              src="<?= htmlspecialchars($d['img']) ?>"
              alt="<?= htmlspecialchars($d['name']) ?>"
              loading="lazy"
            />
          </a>
          <div class="card-text">
            <h3><?= htmlspecialchars($d['name']) ?></h3>
            <p><?= htmlspecialchars($d['country']) ?></p>
            <span class="badge">Explore →</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<!-- ── TRANSPORT OPTIONS ────────────────────────────────── -->
<section id="transport">
  <h2>Transport Options</h2>
  <div class="section-line"></div>
  <div class="grid">
    <?php foreach ($transport as $t): ?>
      <div class="card">
        <img
          src="<?= htmlspecialchars($t['img']) ?>"
          alt="<?= htmlspecialchars($t['label']) ?>"
          loading="lazy"
        />
        <div class="card-text">
          <h3><?= htmlspecialchars($t['icon']) ?> <?= htmlspecialchars($t['label']) ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── TRADITIONAL FOODS ─────────────────────────────────── -->
<section id="foods">
  <h2>Traditional Foods</h2>
  <div class="section-line"></div>
  <div class="grid">
    <?php foreach ($foods as $f): ?>
      <div class="card">
        <img
          src="<?= htmlspecialchars($f['img']) ?>"
          alt="<?= htmlspecialchars($f['name']) ?>"
          loading="lazy"
        />
        <div class="card-text">
          <h3><?= htmlspecialchars($f['name']) ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── BOOKING BANNER ─────────────────────────────────────── -->
<div class="booking-banner">
  <h2>✈️ Ready to Travel?</h2>
  <p>Book your tickets now and experience the world with TravelX.</p>
  <a href="booking.php" class="book-btn">Book a Ticket</a>
</div>

<!-- ── FOOTER ─────────────────────────────────────────────── -->
<footer>
  <h3><?= htmlspecialchars($site['name']) ?></h3>
  <p>Explore the world, one destination at a time.</p>

  <div class="footer-grid">
    <?php foreach ($team as $member): ?>
      <div class="team-card">
        <strong><?= htmlspecialchars($member['name']) ?></strong>
        <span><?= htmlspecialchars($member['role']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <p class="copy">
    &copy; <?= $site['year'] ?> <?= htmlspecialchars($site['name']) ?> &mdash; All Rights Reserved.<br>
    Created with ❤️ by <a href="#">Brainy Bunch Group</a>
  </p>
</footer>

<!-- ── JS ──────────────────────────────────────────────────── -->
<script>
function toggleMenu() {
  document.getElementById('menuList').classList.toggle('open');
}
// Close menu on outside click
document.addEventListener('click', function(e) {
  const nav = document.querySelector('nav');
  if (!nav.contains(e.target)) {
    document.getElementById('menuList').classList.remove('open');
  }
});
</script>

<!-- 🤖 Chat Button -->
<div id="chatbot-btn" onclick="toggleChat()">✈️</div>

<!-- Chat Box -->
<div id="chatbot-box">
    <div id="chat-header">
        ✨ Travel AI Assistant
        <div style="float:right;">
            <span onclick="clearChat()" style="cursor:pointer;margin-right:10px;">🗑️</span>
            <span onclick="toggleChat()" style="cursor:pointer;">❌</span>
        </div>
    </div>

    <div id="chat-messages"></div>

    <!-- Input + Voice -->
    <div style="display:flex;">
        <input type="text" id="chat-input" placeholder="Ask your travel question..." onkeypress="handleKey(event)">
        <button onclick="startVoice()" style="background:#00a699;color:white;border:none;padding:10px;">🎤</button>
    </div>
</div>

<style>
#chatbot-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg,#00a699,#ff6b6b);
    color: white;
    padding: 16px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 22px;
    z-index: 9999;
}

#chatbot-box {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 340px;
    height: 450px;
    background: white;
    border-radius: 12px;
    display: none;
    flex-direction: column;
    box-shadow: 0 0 25px rgba(0,0,0,0.2);
    z-index: 9999;
}

#chat-header {
    background: #00a699;
    color: white;
    padding: 12px;
    font-weight: bold;
}

#chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
}

/* Loader */
.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #00a699;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    animation: spin 1s linear infinite;
    display:inline-block;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// Toggle chatbot
function toggleChat() {
    const box = document.getElementById("chatbot-box");
    box.style.display = box.style.display === "flex" ? "none" : "flex";
}

// Enter key send
function handleKey(e) {
    if (e.key === "Enter") sendMessage();
}

// Load chat history
window.onload = function() {
    const saved = localStorage.getItem("chatHistory");
    if (saved) {
        document.getElementById("chat-messages").innerHTML = saved;
    }
};

// Clear chat
function clearChat() {
    if (confirm("Clear all chat?")) {
        document.getElementById("chat-messages").innerHTML = "";
        localStorage.removeItem("chatHistory");
    }
}

// Auto booking helper
function autoFillBooking(text) {
    if (text.toLowerCase().includes("name")) {
        document.querySelector("input[name='name']")?.focus();
    }
}

// Send message
async function sendMessage() {
    const input = document.getElementById("chat-input");
    const message = input.value.trim();
    if (!message) return;

    const chatBox = document.getElementById("chat-messages");

    chatBox.innerHTML += `<div><b>You:</b> ${message}</div>`;
    input.value = "";

    // typing loader
    const typingId = Date.now();
    chatBox.innerHTML += `<div id="typing-${typingId}"><b>AI:</b> <span class="loader"></span> Thinking...</div>`;
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        const response = await fetch("http://localhost:8000/chat", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                message: message,
                page: window.location.pathname.replace(".php","")
            })
        });

        const data = await response.json();

        document.getElementById(`typing-${typingId}`).remove();

        chatBox.innerHTML += `<div><b>AI:</b> ${data.response}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;

        // Save history
        localStorage.setItem("chatHistory", chatBox.innerHTML);

        autoFillBooking(data.response);

    } catch (error) {
        document.getElementById(`typing-${typingId}`).remove();
        chatBox.innerHTML += `<div style="color:red;">AI not connected</div>`;
    }
}

// Voice input
function startVoice() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (!SpeechRecognition) {
        alert("Voice not supported in this browser");
        return;
    }

    const recognition = new SpeechRecognition();
    recognition.lang = "en-US";

    recognition.onresult = function(event) {
        document.getElementById("chat-input").value =
            event.results[0][0].transcript;
        sendMessage();
    };

    recognition.start();
}
</script>





</body>
</html>
