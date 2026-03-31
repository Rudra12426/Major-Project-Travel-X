<?php
// ============================================================
//  TravelX – Dynamic Booking Page  (booking.php)
// ============================================================

$success  = false;
$errors   = [];
$formData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ── Sanitise & validate ───────────────────────────────
    $formData['name']      = htmlspecialchars(trim($_POST['name']      ?? ''));
    $formData['phone']     = htmlspecialchars(trim($_POST['phone']     ?? ''));
    $formData['email']     = htmlspecialchars(trim($_POST['email']     ?? ''));
    $formData['transport'] = htmlspecialchars(trim($_POST['transport'] ?? ''));
    $formData['from']      = htmlspecialchars(trim($_POST['from']      ?? ''));
    $formData['to']        = htmlspecialchars(trim($_POST['to']        ?? ''));
    $formData['date']      = htmlspecialchars(trim($_POST['date']      ?? ''));
    $formData['passengers']= (int)($_POST['passengers'] ?? 1);

    // Passport / ID fields
    $formData['passport']     = htmlspecialchars(trim($_POST['passport']     ?? ''));
    $formData['nationality']  = htmlspecialchars(trim($_POST['nationality']  ?? ''));
    $formData['id_number']    = htmlspecialchars(trim($_POST['id_number']    ?? ''));
    $formData['id_type']      = htmlspecialchars(trim($_POST['id_type']      ?? ''));

    if (!$formData['name'])      $errors[] = 'Full name is required.';
    if (!preg_match('/^\d{10}$/', $formData['phone'])) $errors[] = 'Valid 10-digit phone required.';
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email required.';
    if (!$formData['transport']) $errors[] = 'Please select a transport option.';
    if (!$formData['from'])      $errors[] = 'Departure city is required.';
    if (!$formData['to'])        $errors[] = 'Destination city is required.';
    if (!$formData['date'])      $errors[] = 'Travel date is required.';

    if ($formData['transport'] === 'airplane') {
        if (!$formData['passport'])    $errors[] = 'Passport number is required.';
        if (!$formData['nationality']) $errors[] = 'Nationality is required.';
    } elseif (in_array($formData['transport'], ['train','bus'])) {
        if (!$formData['id_number']) $errors[] = 'ID number is required.';
        if (!$formData['id_type'])   $errors[] = 'ID type is required.';
    }

    if (empty($errors)) {
        $success = true;
        // Here you would INSERT into your DB / send email etc.
    }
}

$year = date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>TravelX – Book Your Journey</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

<style>
/* ─── VARIABLES & RESET ─────────────────────────────── */
:root{
  --crimson:#8B0000;
  --amber:#FFA500;
  --gold:#FFD700;
  --dark:#0d0d0d;
  --card:#ffffff;
  --muted:#6b7280;
  --border:#e5e7eb;
  --radius:18px;
  --shadow:0 20px 60px rgba(0,0,0,.18);
  --glow:0 0 40px rgba(255,165,0,.35);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  font-family:'DM Sans',sans-serif;
  background:var(--dark);
  min-height:100vh;
  overflow-x:hidden;
}

/* ─── ANIMATED SKY BACKGROUND ───────────────────────── */
.sky{
  position:fixed;inset:0;z-index:0;
  background:linear-gradient(160deg,#0a0010 0%,#1a0020 30%,#3d0000 60%,#7a3500 100%);
}
.sky::before{
  content:'';position:absolute;inset:0;
  background:
    radial-gradient(ellipse 80% 50% at 20% 30%,rgba(139,0,0,.45) 0%,transparent 60%),
    radial-gradient(ellipse 60% 40% at 80% 70%,rgba(255,165,0,.25) 0%,transparent 55%),
    radial-gradient(ellipse 40% 30% at 50% 10%,rgba(255,215,0,.12) 0%,transparent 50%);
  animation:skyShift 12s ease-in-out infinite alternate;
}
@keyframes skyShift{
  from{opacity:.8;transform:scale(1)}
  to  {opacity:1;transform:scale(1.03)}
}

/* ─── STARS ──────────────────────────────────────────── */
.stars{position:fixed;inset:0;z-index:0;overflow:hidden;pointer-events:none}
.star{
  position:absolute;border-radius:50%;
  background:#fff;animation:twinkle var(--dur,3s) ease-in-out infinite;
  animation-delay:var(--delay,0s);
}
@keyframes twinkle{
  0%,100%{opacity:.15;transform:scale(1)}
  50%{opacity:.9;transform:scale(1.4)}
}

/* ─── FLOATING PLANE ─────────────────────────────────── */
.plane-anim{
  position:fixed;top:12%;left:-140px;font-size:3.2rem;z-index:1;
  animation:flyAcross 18s linear infinite;filter:drop-shadow(0 0 10px rgba(255,215,0,.7));
}
@keyframes flyAcross{
  0%  {left:-140px;top:12%;opacity:0}
  5%  {opacity:1}
  95% {opacity:1}
  100%{left:110%;top:8%;opacity:0}
}

/* ─── CLOUDS ─────────────────────────────────────────── */
.cloud{
  position:fixed;border-radius:50px;opacity:.07;pointer-events:none;z-index:1;
  animation:drift var(--speed,60s) linear infinite;
  background:rgba(255,255,255,.9);
}
@keyframes drift{from{left:-400px}to{left:110%}}

/* ─── WRAPPER ────────────────────────────────────────── */
.page{position:relative;z-index:2;padding:30px 20px 60px;display:flex;flex-direction:column;align-items:center}

/* ─── BACK LINK ──────────────────────────────────────── */
.back{
  align-self:flex-start;margin-bottom:20px;
  color:rgba(255,255,255,.6);font-size:.9rem;text-decoration:none;
  display:flex;align-items:center;gap:6px;transition:color .2s;
}
.back:hover{color:var(--gold)}

/* ─── HEADER ─────────────────────────────────────────── */
.page-header{text-align:center;margin-bottom:40px;animation:fadeDown .9s ease both}
@keyframes fadeDown{from{opacity:0;transform:translateY(-30px)}to{opacity:1;transform:translateY(0)}}
.page-header .brand{
  font-family:'Playfair Display',serif;
  font-size:clamp(2.2rem,6vw,4rem);
  background:linear-gradient(135deg,var(--gold),var(--amber),var(--crimson));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  line-height:1.1;letter-spacing:-1px;
}
.page-header p{color:rgba(255,255,255,.55);margin-top:8px;font-size:1rem;font-weight:300;letter-spacing:.5px}

/* ─── CARD ───────────────────────────────────────────── */
.card{
  width:100%;max-width:780px;
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.1);
  border-radius:var(--radius);
  backdrop-filter:blur(20px);
  -webkit-backdrop-filter:blur(20px);
  padding:40px 44px;
  box-shadow:var(--shadow);
  animation:riseUp .9s ease .2s both;
}
@keyframes riseUp{from{opacity:0;transform:translateY(50px)}to{opacity:1;transform:translateY(0)}}

/* ─── SECTION TITLE ──────────────────────────────────── */
.section-title{
  font-family:'Playfair Display',serif;
  font-size:1.35rem;color:var(--amber);
  margin:32px 0 18px;
  padding-bottom:8px;
  border-bottom:1px solid rgba(255,165,0,.2);
  display:flex;align-items:center;gap:10px;
}
.section-title:first-child{margin-top:0}

/* ─── GRID ───────────────────────────────────────────── */
.row{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.row.trio{grid-template-columns:1fr 1fr 1fr}

/* ─── FORM FIELDS ────────────────────────────────────── */
.field{display:flex;flex-direction:column;gap:6px}
.field label{font-size:.82rem;font-weight:600;color:rgba(255,255,255,.65);letter-spacing:.5px;text-transform:uppercase}
.field input,
.field select{
  padding:13px 16px;
  border-radius:12px;
  border:1.5px solid rgba(255,255,255,.12);
  background:rgba(255,255,255,.07);
  color:#fff;font-size:.98rem;font-family:'DM Sans',sans-serif;
  transition:border .25s,box-shadow .25s,background .25s;
  outline:none;
}
.field input::placeholder{color:rgba(255,255,255,.3)}
.field select option{background:#1a1a2e;color:#fff}
.field input:focus,
.field select:focus{
  border-color:var(--amber);
  box-shadow:0 0 0 3px rgba(255,165,0,.18);
  background:rgba(255,165,0,.06);
}
.field input[type=file]{cursor:pointer;padding:10px 14px}

/* ─── TRANSPORT TABS ─────────────────────────────────── */
.transport-tabs{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:4px}
.tab-label{
  display:flex;flex-direction:column;align-items:center;gap:8px;
  padding:18px 10px;border-radius:14px;cursor:pointer;
  border:2px solid rgba(255,255,255,.1);
  background:rgba(255,255,255,.04);
  color:rgba(255,255,255,.6);
  transition:all .25s;font-size:.88rem;font-weight:500;
}
.tab-label .emoji{font-size:2rem}
.tab-label:hover{border-color:rgba(255,165,0,.5);color:var(--amber);background:rgba(255,165,0,.06)}
input[type=radio]:checked + .tab-label,
.tab-label.active{
  border-color:var(--amber);background:rgba(255,165,0,.14);
  color:var(--amber);box-shadow:0 0 18px rgba(255,165,0,.2);
}
input[type=radio].tab-radio{display:none}

/* ─── DYNAMIC SECTION ────────────────────────────────── */
.dyn-section{
  overflow:hidden;max-height:0;opacity:0;
  transition:max-height .5s cubic-bezier(.4,0,.2,1),opacity .4s ease,margin .3s ease;
  margin-top:0;
}
.dyn-section.open{max-height:500px;opacity:1;margin-top:24px}

/* ─── PASSENGERS STEPPER ─────────────────────────────── */
.stepper{display:flex;align-items:center;gap:0;border-radius:12px;overflow:hidden;border:1.5px solid rgba(255,255,255,.12);width:fit-content}
.stepper button{
  width:44px;height:46px;background:rgba(255,255,255,.08);border:none;
  color:#fff;font-size:1.4rem;cursor:pointer;transition:background .2s;flex-shrink:0;
}
.stepper button:hover{background:rgba(255,165,0,.25)}
.stepper input{
  width:58px;text-align:center;border:none!important;border-radius:0!important;
  box-shadow:none!important;background:rgba(255,255,255,.06)!important;
  font-weight:600;font-size:1.1rem;
}

/* ─── SUBMIT BUTTON ──────────────────────────────────── */
.submit-btn{
  width:100%;padding:17px;margin-top:34px;
  background:linear-gradient(135deg,var(--crimson),var(--amber));
  color:#fff;font-size:1.1rem;font-weight:700;letter-spacing:.5px;
  border:none;border-radius:14px;cursor:pointer;
  font-family:'DM Sans',sans-serif;
  position:relative;overflow:hidden;
  transition:transform .2s,box-shadow .2s;
  box-shadow:0 6px 28px rgba(139,0,0,.4);
}
.submit-btn::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.15),transparent);
  transform:translateX(-100%);transition:transform .4s ease;
}
.submit-btn:hover{transform:translateY(-2px);box-shadow:0 10px 40px rgba(255,165,0,.4)}
.submit-btn:hover::before{transform:translateX(0)}
.submit-btn:active{transform:translateY(0)}

/* ─── ALERTS ─────────────────────────────────────────── */
.alert{border-radius:12px;padding:16px 20px;margin-bottom:24px;font-size:.95rem;animation:fadeDown .5s ease both}
.alert-error{background:rgba(220,38,38,.15);border:1px solid rgba(220,38,38,.4);color:#fca5a5}
.alert-error ul{margin:6px 0 0 18px;line-height:1.8}
.alert-success{background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.4);color:#6ee7b7;text-align:center}
.alert-success .tick{font-size:3.5rem;display:block;margin-bottom:8px;animation:pop .5s cubic-bezier(.36,.07,.19,.97) both}
@keyframes pop{0%{transform:scale(0)}70%{transform:scale(1.3)}100%{transform:scale(1)}}
.alert-success h3{font-family:'Playfair Display',serif;font-size:1.6rem;color:var(--gold);margin-bottom:6px}
.alert-success p{opacity:.8;line-height:1.6}
.alert-success .ref{
  display:inline-block;margin-top:12px;
  background:rgba(255,215,0,.1);border:1px solid rgba(255,215,0,.3);
  border-radius:8px;padding:8px 18px;font-weight:600;color:var(--gold);letter-spacing:1px;font-size:1rem;
}

/* ─── DIVIDER ────────────────────────────────────────── */
.divider{height:1px;background:rgba(255,255,255,.08);margin:28px 0}

/* ─── FOOTER ─────────────────────────────────────────── */
.footer-ticker{
  width:100%;max-width:780px;margin-top:36px;
  background:rgba(0,0,0,.4);border:1px solid rgba(255,255,255,.08);
  border-radius:10px;overflow:hidden;padding:12px 0;
}
.ticker-inner{
  display:flex;white-space:nowrap;
  animation:ticker 30s linear infinite;
  color:rgba(255,255,255,.45);font-size:.83rem;gap:0;
}
@keyframes ticker{from{transform:translateX(100%)}to{transform:translateX(-100%)}}
.ticker-item{margin:0 40px;flex-shrink:0}
.ticker-item a{color:var(--amber);text-decoration:none}

/* ─── RESPONSIVE ─────────────────────────────────────── */
@media(max-width:640px){
  .card{padding:26px 20px}
  .row,.row.trio{grid-template-columns:1fr}
  .transport-tabs{grid-template-columns:repeat(3,1fr)}
  .tab-label{padding:12px 6px;font-size:.78rem}
  .tab-label .emoji{font-size:1.6rem}
}
</style>
</head>
<body>

<!-- ── BACKGROUND LAYERS ─────────────────────────────────── -->
<div class="sky"></div>
<div class="stars" id="starField"></div>
<div class="plane-anim">✈️</div>

<!-- Clouds -->
<div class="cloud" style="width:300px;height:60px;top:15%;--speed:70s;animation-delay:-10s"></div>
<div class="cloud" style="width:200px;height:45px;top:35%;--speed:90s;animation-delay:-30s"></div>
<div class="cloud" style="width:380px;height:70px;top:55%;--speed:55s;animation-delay:-5s"></div>

<!-- ── PAGE ──────────────────────────────────────────────── -->
<div class="page">

  <a href="index.php" class="back">← Back to Home</a>

  <!-- HEADER -->
  <div class="page-header">
    <div class="brand">✈ TravelX Booking</div>
    <p>Reserve your journey in seconds. We handle the rest.</p>
  </div>

  <!-- MAIN CARD -->
  <div class="card">

    <?php if ($success): ?>
    <!-- ── SUCCESS STATE ────────────────────────────────── -->
    <div class="alert alert-success">
      <span class="tick">🎉</span>
      <h3>Booking Confirmed!</h3>
      <p>
        Thank you, <strong><?= $formData['name'] ?></strong>!<br>
        Your <?= $formData['transport'] ?> from <strong><?= $formData['from'] ?></strong>
        to <strong><?= $formData['to'] ?></strong> on <strong><?= date('d M Y', strtotime($formData['date'])) ?></strong>
        is booked for <?= $formData['passengers'] ?> passenger<?= $formData['passengers'] > 1 ? 's' : '' ?>.
        <br>Confirmation details have been sent to <strong><?= $formData['email'] ?></strong>.
      </p>
      <div class="ref">REF: TRX-<?= strtoupper(substr(md5($formData['email'].time()), 0, 8)) ?></div>
    </div>
    <a href="booking.php" class="submit-btn" style="display:block;text-align:center;text-decoration:none;line-height:1;padding:17px">
      + Book Another Trip
    </a>

    <?php else: ?>
    <!-- ── ERRORS ─────────────────────────────────────── -->
    <?php if (!empty($errors)): ?>
    <div class="alert alert-error">
      ⚠️ <strong>Please fix the following:</strong>
      <ul><?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul>
    </div>
    <?php endif; ?>

    <!-- ── FORM ──────────────────────────────────────── -->
    <form method="POST" action="booking.php" enctype="multipart/form-data" novalidate>

      <!-- PERSONAL DETAILS -->
      <div class="section-title">👤 Personal Details</div>

      <div class="row">
        <div class="field">
          <label>Full Name</label>
          <input type="text" name="name" placeholder="e.g. Aditya Singh"
            value="<?= $formData['name'] ?? '' ?>" required/>
        </div>
        <div class="field">
          <label>Phone Number</label>
          <input type="tel" name="phone" placeholder="10-digit number"
            value="<?= $formData['phone'] ?? '' ?>" required maxlength="10"/>
        </div>
      </div>

      <div class="field" style="margin-top:18px">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="you@example.com"
          value="<?= $formData['email'] ?? '' ?>" required/>
      </div>

      <div class="divider"></div>

      <!-- JOURNEY DETAILS -->
      <div class="section-title">🗺️ Journey Details</div>

      <div class="row">
        <div class="field">
          <label>From (City / Airport)</label>
          <input type="text" name="from" placeholder="Departure city"
            value="<?= $formData['from'] ?? '' ?>" required/>
        </div>
        <div class="field">
          <label>To (City / Airport)</label>
          <input type="text" name="to" placeholder="Destination city"
            value="<?= $formData['to'] ?? '' ?>" required/>
        </div>
      </div>

      <div class="row" style="margin-top:18px">
        <div class="field">
          <label>Travel Date</label>
          <input type="date" name="date"
            value="<?= $formData['date'] ?? '' ?>"
            min="<?= date('Y-m-d') ?>" required/>
        </div>
        <div class="field">
          <label>Passengers</label>
          <div class="stepper">
            <button type="button" onclick="stepPax(-1)">−</button>
            <input type="number" name="passengers" id="paxInput" value="<?= $formData['passengers'] ?? 1 ?>" min="1" max="9" readonly/>
            <button type="button" onclick="stepPax(1)">+</button>
          </div>
        </div>
      </div>

      <div class="divider"></div>

      <!-- TRANSPORT TYPE -->
      <div class="section-title">🚦 Select Transport</div>

      <div class="transport-tabs">
        <?php
        $transports = [
          ['airplane','✈️','Airplane'],
          ['train',   '🚆','Train'],
          ['bus',     '🚌','Bus'],
        ];
        foreach ($transports as [$val,$emoji,$label]):
          $checked = (($formData['transport'] ?? '') === $val) ? 'checked' : '';
        ?>
        <input type="radio" class="tab-radio" name="transport"
               id="t_<?= $val ?>" value="<?= $val ?>" <?= $checked ?>
               onchange="switchTransport('<?= $val ?>')"/>
        <label for="t_<?= $val ?>" class="tab-label <?= $checked ? 'active' : '' ?>">
          <span class="emoji"><?= $emoji ?></span>
          <?= $label ?>
        </label>
        <?php endforeach; ?>
      </div>

      <!-- AIRPLANE SECTION -->
      <div id="sec_airplane" class="dyn-section <?= ($formData['transport']??'')==='airplane'?'open':'' ?>">
        <div class="section-title" style="margin-top:0">🛂 Passport Details</div>
        <div class="row">
          <div class="field">
            <label>Passport Number</label>
            <input type="text" name="passport" placeholder="A1234567"
              value="<?= $formData['passport'] ?? '' ?>"/>
          </div>
          <div class="field">
            <label>Nationality</label>
            <input type="text" name="nationality" placeholder="Indian"
              value="<?= $formData['nationality'] ?? '' ?>"/>
          </div>
        </div>
        <div class="field" style="margin-top:18px">
          <label>Upload Passport Image</label>
          <input type="file" name="passport_img" accept="image/*"/>
        </div>
      </div>

      <!-- TRAIN / BUS SECTION -->
      <div id="sec_idbased" class="dyn-section <?= in_array($formData['transport']??'',['train','bus'])?'open':'' ?>">
        <div class="section-title" style="margin-top:0">🪪 ID Proof Details</div>
        <div class="row">
          <div class="field">
            <label>ID Number</label>
            <input type="text" name="id_number" placeholder="XXXX-XXXX-XXXX"
              value="<?= $formData['id_number'] ?? '' ?>"/>
          </div>
          <div class="field">
            <label>ID Type</label>
            <select name="id_type">
              <option value="">-- Select --</option>
              <?php
              $idTypes = ['Aadhar Card','Voter ID','Driving License','PAN Card','Passport'];
              foreach ($idTypes as $it):
                $sel = (($formData['id_type'] ?? '') === $it) ? 'selected' : '';
              ?>
              <option value="<?= $it ?>" <?= $sel ?>><?= $it ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="field" style="margin-top:18px">
          <label>Upload ID Image</label>
          <input type="file" name="id_img" accept="image/*"/>
        </div>
      </div>

      <!-- SUBMIT -->
      <button type="submit" class="submit-btn">
        🎫 &nbsp; Confirm My Booking
      </button>

    </form>
    <?php endif; ?>

  </div><!-- /.card -->

  <!-- FOOTER TICKER -->
  <div class="footer-ticker">
    <div class="ticker-inner">
      <?php
      $team = [
        ['Aditya Singh','Frontend Developer & UI Designer'],
        ['Rudra Pratap Rai','Content Writer & Image Curator'],
        ['Ankit Kumar Tiwari','JS Developer & Search'],
        ['Ashish Kumar Singh','CSS Stylist & Layout Designer'],
        ['Aman Singh','Tester & Documentation Lead'],
      ];
      // repeat for continuous scroll
      for ($i=0;$i<3;$i++):
        foreach ($team as [$n,$r]):
      ?>
      <span class="ticker-item">🔹 <strong style="color:rgba(255,255,255,.75)"><?= $n ?></strong> – <?= $r ?></span>
      <?php endforeach; endfor; ?>
      <span class="ticker-item">© <?= $year ?> <a href="index.php">TravelX</a>. All Rights Reserved.</span>
    </div>
  </div>

</div><!-- /.page -->

<!-- ── JAVASCRIPT ─────────────────────────────────────── -->
<script>
/* ── Star field ────────────────────────────────────── */
(function(){
  const field = document.getElementById('starField');
  const W = window.innerWidth, H = window.innerHeight;
  for(let i=0;i<160;i++){
    const s = document.createElement('div');
    const sz = Math.random()*2.2+.5;
    s.className='star';
    s.style.cssText=`
      left:${Math.random()*100}%;top:${Math.random()*100}%;
      width:${sz}px;height:${sz}px;
      --dur:${(Math.random()*4+2).toFixed(1)}s;
      --delay:-${(Math.random()*5).toFixed(1)}s;
    `;
    field.appendChild(s);
  }
})();

/* ── Transport switch ──────────────────────────────── */
function switchTransport(val){
  document.querySelectorAll('.tab-label').forEach(l=>l.classList.remove('active'));
  const lbl = document.querySelector(`label[for="t_${val}"]`);
  if(lbl) lbl.classList.add('active');

  document.getElementById('sec_airplane').classList.remove('open');
  document.getElementById('sec_idbased').classList.remove('open');

  if(val==='airplane')              document.getElementById('sec_airplane').classList.add('open');
  if(val==='train'||val==='bus')    document.getElementById('sec_idbased').classList.add('open');
}

/* ── Passengers stepper ────────────────────────────── */
function stepPax(dir){
  const inp = document.getElementById('paxInput');
  let v = parseInt(inp.value)+dir;
  inp.value = Math.min(9,Math.max(1,v));
}

/* ── Input focus glow ──────────────────────────────── */
document.querySelectorAll('.field input, .field select').forEach(el=>{
  el.addEventListener('focus',()=>el.closest('.field').style.transform='scale(1.01)');
  el.addEventListener('blur', ()=>el.closest('.field').style.transform='scale(1)');
});
document.querySelectorAll('.field').forEach(f=>f.style.transition='transform .2s');
</script>
</body>
</html>
