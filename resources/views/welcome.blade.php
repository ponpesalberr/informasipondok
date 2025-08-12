<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Informasi Santri - Login & Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #d1d5db; /* Tailwind gray-300 */
      margin: 0;
      min-height: 100vh;
    }
    /* Sidebar styles */
    .sidebar {
      background-color: #1f2937; /* Tailwind gray-800 */
      width: 64px;
      min-height: 100vh;
      color: #e5e7eb; /* gray-200 */
      position: fixed;
      top: 0;
      left: 0;
      padding-top: 1rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
      z-index: 30;
    }
    .sidebar svg {
      width: 28px;
      height: 28px;
      cursor: pointer;
      fill: #9ca3af; /* gray-400 */
      transition: fill 0.3s ease;
    }
    .sidebar svg:hover {
      fill: #34d399; /* green-400 */
    }
    /* Topbar styles */
    .topbar {
      background-color: #047857; /* Tailwind emerald-700 */
      color: white;
      height: 56px;
      padding: 0 1rem;
      padding-left: 80px; /* account for sidebar + gap */
      display: flex;
      align-items: center;
      gap: 1rem;
      position: sticky;
      top: 0;
      z-index: 20;
    }
    .topbar h1 {
      font-weight: 700;
      font-size: 1.25rem;
      flex-grow: 1;
    }

    .icon-btn {
      position: relative;
      cursor: pointer;
      margin-left: 0.75rem;
    }
    .icon-btn svg {
      width: 22px;
      height: 22px;
      fill: white;
    }
    .icon-badge {
      position: absolute;
      top: -6px;
      right: -6px;
      background: #ef4444; /* red-500 */
      color: white;
      font-size: 0.65rem;
      font-weight: 700;
      width: 16px;
      height: 16px;
      border-radius: 9999px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Login form styles */
    #loginPage {
      background-color: #047857;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
    }
    .login-container {
      background-color: white;
      padding: 2rem 2.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-container h2 {
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
      text-align: center;
      color: #047857;
    }
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #374151; /* gray-700 */
    }
    .form-group input {
      width: 100%;
      padding: 0.5rem 0.75rem;
      font-size: 1rem;
      border: 1.5px solid #9ca3af; /* gray-400 */
      border-radius: 0.375rem;
      outline-offset: 2px;
      transition: border-color 0.3s ease;
    }
    .form-group input:focus {
      border-color: #047857;
      outline: none;
    }
    .btn-login {
      background-color: #047857;
      color: white;
      width: 100%;
      padding: 0.75rem;
      font-weight: 700;
      font-size: 1.1rem;
      border: none;
      border-radius: 0.375rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn-login:hover {
      background-color: #065f46;
    }
    .login-error {
      color: #dc2626; /* red-600 */
      margin-top: 0.75rem;
      font-weight: 600;
      text-align: center;
    }

    /* Dashboard styles */
    #dashboardPage {
      display: none;
      margin-left: 64px;
      padding: 1rem 2rem 2rem 2rem;
      min-height: 100vh;
    }
    .dashboard-header {
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 1rem;
      color: #111827; /* gray-900 */
    }
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(320px,1fr));
      gap: 1rem;
      margin-top: 1rem;
    }
    .card {
      background-color: white;
      padding: 1rem 1.5rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 10px rgb(0 0 0 / 0.06);
    }
    .card-header {
      border-left: 4px solid #047857;
      padding-left: 0.75rem;
      font-weight: 700;
      font-size: 1.1rem;
      margin-bottom: 0.75rem;
      color: #134e4a;
      user-select:none;
    }
    /* User Info Card */
    .user-info {
      display: flex;
      align-items: center;
      gap: 1.25rem;
    }
    .avatar {
      width: 64px;
      height: 64px;
      background-color: #a78bfa; /* violet-400 */
      border-radius: 9999px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #6b21a8; /* violet-700 */
      font-size: 2rem;
      user-select:none;
      flex-shrink: 0;
    }
    .user-details {
      flex-grow: 1;
    }
    .user-details .name {
      font-weight: 700;
      font-size: 1.1rem;
      color: #111827;
    }
    .user-details .subtitle {
      font-size: 0.9rem;
      color: #4b5563; /* gray-600 */
      user-select:none;
    }
    /* Kegiatan Card */
    .schedule-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
    }
    .schedule-item {
      background-color: #6b7280; /* gray-500 */
      padding: 0.3rem 0.75rem;
      border-radius: 0.375rem;
      color: white;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 0.95rem;
      cursor: default;
      user-select:none;
    }
    .schedule-item.active {
      background-color: #374151; /* gray-700 */
      position: relative;
    }
    .schedule-item.active::before {
      content: '';
      display: inline-block;
      width: 0; 
      height: 0; 
      border-top: 8px solid transparent;
      border-bottom: 8px solid transparent;
      border-right: 8px solid #dc2626; /* red-600 */
      position: absolute;
      left: -16px;
    }
    .time {
      width: 50px;
      text-align: right;
      font-weight: 600;
    }
    .countdown {
      margin-top: 0.5rem;
      display: flex;
      gap: 0.25rem;
      align-items: center;
      user-select:none;
      font-weight: 700;
      font-family: 'Courier New', Courier, monospace;
      font-size: 1.2rem;
    }
    .countdown span {
      background-color: #4b5563; /* gray-600 */
      color: white;
      padding: 0.1rem 0.4rem;
      border-radius: 0.25rem;
      min-width: 24px;
      text-align: center;
    }
    .countdown .sep {
      color: #374151; /* gray-700 */
      font-weight: normal;
      font-family: serif;
    }
    .link-more {
      text-align: right;
      margin-top: 0.5rem;
      font-size: 0.9rem;
      color: #8b5cf6; /* violet-500 */
      cursor: pointer;
      user-select:none;
    }
    .link-more:hover {
      text-decoration: underline;
    }
    /* Info Kunjungan */
    .visit-info {
      display: flex;
      gap: 1rem;
      user-select:none;
    }
    .visit-left {
      flex-basis: 25%;
      font-size: 0.95rem;
      font-weight: 700;
      color: #065f46; /* emerald-800 */
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-right: 2px solid #9ca3af;
      padding-right: 1rem;
    }
    .visit-left .count {
      background-color: #4b5563;
      color: white;
      font-size: 2rem;
      padding: 0.35rem 0.75rem;
      border-radius: 0.375rem;
      margin-top: 0.5rem;
      user-select:text;
    }
    .visit-right {
      flex-basis: 75%;
      padding-left: 1rem;
      font-size: 0.9rem;
      border-left: 0;
      color: #374151;
    }
    .visit-list {
      padding-left: 0;
      margin-top: 0.25rem;
      user-select:none;
    }
    .visit-item {
      background-color: #4b5563;
      color: white;
      margin-bottom: 0.4rem;
      padding: 0.35rem 0.75rem;
      border-radius: 0.375rem;
      display: flex;
      justify-content: space-between;
    }
    /* Saldo Card */
    .saldo-amount {
      background-color: #4b5563;
      color: white;
      padding: 0.5rem 1.25rem;
      border-radius: 0.375rem;
      max-width: max-content;
      font-weight: 700;
      user-select:text;
    }
    /* Scrollbar for left sidebar if needed */
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }
    .sidebar::-webkit-scrollbar-thumb {
      background-color: #34d399;
      border-radius: 3px;
    }
    /* Responsive adjustments */
    @media (max-width: 640px) {
      #dashboardPage {
        margin-left: 0;
        padding: 1rem;
      }
      .topbar {
        padding-left: 1rem;
      }
      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>

  <!-- Login Page -->
  <main id="loginPage" aria-label="Login page for Informasi Santri system">
    <section class="login-container" role="form" aria-labelledby="loginTitle">
      <h2 id="loginTitle">Silakan Masuk</h2>
      <form id="loginForm" novalidate>
        <div class="form-group">
          <label for="usernameInput">Nama Pengguna</label>
          <input type="text" id="usernameInput" name="username" autocomplete="username" placeholder="Masukkan nama pengguna" required aria-required="true" />
        </div>
        <div class="form-group">
          <label for="passwordInput">Kata Sandi</label>
          <input type="password" id="passwordInput" name="password" autocomplete="current-password" placeholder="Masukkan kata sandi" required aria-required="true" />
        </div>
        <button type="submit" class="btn-login" aria-label="Masuk ke dashboard">Masuk</button>
        <p id="loginError" class="login-error" role="alert" aria-live="assertive" style="display:none;"></p>
      </form>
    </section>
  </main>

  <!-- Dashboard Page -->
  <main id="dashboardPage" aria-label="Dashboard Informasi Santri">

    <!-- Sidebar -->
    <nav class="sidebar" aria-label="Menu Navigasi Utama">
      <button aria-label="Toggle menu sidebar" id="menuToggle" class="mt-1 mb-3 hover:text-green-400" title="Toggle Menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M3 12h18M3 6h18M3 18h18" />
        </svg>
      </button>
      <!-- Icons from inline SVG for Home, users, calendar, clipboard, user group, wallet, info -->
      <svg role="img" aria-label="Beranda" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 9.5L12 3l9 6.5v11.5a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></svg>
      <svg role="img" aria-label="Data Santri" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm-7 8a7 7 0 0 1 14 0v1H5v-1z"/></svg>
      <svg role="img" aria-label="Jadwal" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="15" rx="2" ry="2" fill="none" stroke="currentColor" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke="currentColor" stroke-width="2"/><line x1="8" y1="2" x2="8" y2="6" stroke="currentColor" stroke-width="2"/></svg>
      <svg role="img" aria-label="Catatan" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4l2-3h6a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2z"/></svg>
      <svg role="img" aria-label="Asatidzah" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="7" r="5"/><path d="M17 14c-3.5 0-7 1.757-7 5v3h14v-3c0-3.243-3.5-5-7-5z"/></svg>
      <svg role="img" aria-label="Keuangan" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1v22m-7-11h14"/></svg>
      <svg role="img" aria-label="Informasi" tabindex="0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><line x1="12" y1="16" x2="12" y2="12" stroke="currentColor" stroke-width="2"/><line x1="12" y1="8" x2="12" y2="8" stroke="currentColor" stroke-width="2"/></svg>
    </nav>

    <!-- Topbar -->
    <header class="topbar" role="banner">
      <button aria-label="Buka menu navigasi" id="sidebarMenuButton" class="mr-3 hidden sm:block">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true">
          <path d="M3 6h18M3 12h18M3 18h18" />
        </svg>
      </button>
      <h1>INFORMASI SANTRI</h1>
      <div class="icon-btn" tabindex="0" role="button" aria-label="Notifikasi pesan">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M21 6h-6l-4-4-4 4H3v14h18z"/>
        </svg>
        <span class="icon-badge" aria-live="polite" aria-atomic="true">1</span>
      </div>
      <div class="icon-btn" tabindex="0" role="button" aria-label="Notifikasi alarm dan pengingat">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 5a7 7 0 0 1 7 7v5h-14v-5a7 7 0 0 1 7-7z"/>
        </svg>
        <span class="icon-badge" aria-live="polite" aria-atomic="true">1</span>
      </div>
      <button id="logoutBtn" class="ml-6 bg-emerald-800 px-3 py-1 rounded text-white hover:bg-emerald-900" aria-label="Keluar dari dashboard">Logout</button>
    </header>

    <!-- Main Dashboard Content -->
    <section aria-labelledby="dashboardTitle">
      <h2 id="dashboardTitle" class="dashboard-header">Dasboard</h2>
      
      <div class="dashboard-grid">

        <!-- Selamat Datang -->
        <section aria-label="Informasi pengguna">
          <div class="card">
            <h3 class="card-header">Selamat Datang!</h3>
            <div class="user-info">
              <div class="avatar" id="userAvatar" aria-hidden="true" title="Avatar pengguna">
                <svg width="36" height="36" fill="#6b21a8" viewBox="0 0 24 24" aria-hidden="true">
                  <circle cx="12" cy="8" r="4" />
                  <path d="M6 20c0-3.3 5-4 6-4s6 .7 6 4v1H6v-1z" />
                </svg>
              </div>
              <div class="user-details" id="userDetails" aria-live="polite" aria-atomic="true">
                <p><strong><span id="userFullName">AHMAD RIFQI AL ASYROFI</span></strong> <span class="subtitle">(0417)</span></p>
                <p class="subtitle">KAMAR : <span id="userRoom">13</span></p>
                <p class="subtitle">KELAS : <span id="userClass">Lulus (Asatidzah 1)</span></p>
                <p class="subtitle">ALAMAT: <span id="userAddress">Graha Candi Permai Bakalan Bugulkidul Pasuruan Jawa Timur</span></p>
              </div>
            </div>
          </div>
        </section>

        <!-- Kegiatan Hari Ini -->
        <section aria-label="Kegiatan hari ini">
          <div class="card" id="scheduleCard">
            <h3 class="card-header">Kegiatan Hari Ini</h3>
            <ul class="schedule-list" id="scheduleList" aria-live="polite" aria-atomic="true" role="list">
              <li class="schedule-item active" tabindex="0">
                <span class="time">20:15</span> Musyawarah Malam
              </li>
              <li class="schedule-item" tabindex="0">
                <span class="time">22:15</span> Istirahat
              </li>
              <li class="schedule-item" tabindex="0">
                <span class="time">23:00</span> Tidur Wajib
              </li>
            </ul>
            <div class="countdown" aria-live="polite" aria-atomic="true" aria-label="Hitung mundur ke kegiatan berikutnya" role="timer" id="countdownTimer" title="Hitung mundur ke kegiatan berikutnya">
              <span id="cdHours">2</span><span class="sep">:</span><span id="cdMinutes">0</span><span class="sep">:</span><span id="cdSeconds">3</span><span class="sep">:</span><span id="cdMs">57</span>
            </div>
            <div class="link-more" tabindex="0" role="link" aria-label="Lihat selengkapnya kegiatan hari ini" id="moreSchedule">Selengkapnya</div>
          </div>
        </section>

        <!-- Informasi Kunjungan -->
        <section aria-label="Informasi kunjungan">
          <div class="card visit-info">
            <div class="visit-left">
              <p>SISA KUNJUNGAN<br />BULAN INI:</p>
              <div class="count" id="visitLeft">0</div>
            </div>
            <div class="visit-right" aria-live="polite" aria-atomic="true">
              <h3 class="card-header" style="margin-top:0; margin-bottom:0.5rem; border-left:none; padding-left:0;">Riwayat Kunjungan Bulan Ini:</h3>
              <ul class="visit-list" id="visitList" role="list">
                <li class="visit-item" tabindex="0">
                  1. Ahad, 17 Agustus 2025 <span>Pukul 08:00 - 15:00</span>
                </li>
                <li class="visit-item" tabindex="0">
                  2. Ahad, 24 Agustus 2025 <span>Pukul 08:30 - 15:30</span>
                </li>
              </ul>
              <div class="link-more" tabindex="0" role="link" aria-label="Lihat selengkapnya riwayat kunjungan bulan ini" id="moreVisits">Selengkapnya</div>
            </div>
          </div>
        </section>

        <!-- Saldo Santri -->
        <section aria-label="Saldo santri">
          <div class="card">
            <h3 class="card-header">Saldo Santri</h3>
            <div class="saldo-amount" id="userBalance">Rp. 1.000.000</div>
          </div>
        </section>

      </div>
    </section>
  </main>

  <script>
    "use strict";

    // Dummy user data for login verification and dashboard filling
    const users = [
      {
        username: "santri0417",
        password: "password123",
        fullName: "AHMAD RIFQI AL ASYROFI",
        id: "0417",
        room: "13",
        userClass: "Lulus (Asatidzah 1)",
        address: "Graha Candi Permai Bakalan Bugulkidul Pasuruan Jawa Timur",
        visitsLeft: 0,
        visitHistory: [
          { date: "Ahad, 17 Agustus 2025", time: "Pukul 08:00 - 15:00" },
          { date: "Ahad, 24 Agustus 2025", time: "Pukul 08:30 - 15:30" }
        ],
        balance: "Rp. 1.000.000",
        schedule: [
          { time: "20:15", activity: "Musyawarah Malam" },
          { time: "22:15", activity: "Istirahat" },
          { time: "23:00", activity: "Tidur Wajib" }
        ]
      }
    ];

    // Elements refs
    const loginPage = document.getElementById('loginPage');
    const dashboardPage = document.getElementById('dashboardPage');
    const loginForm = document.getElementById('loginForm');
    const loginError = document.getElementById('loginError');
    const logoutBtn = document.getElementById('logoutBtn');

    // Dashboard elements to update on login
    const userFullNameElem = document.getElementById('userFullName');
    const userRoomElem = document.getElementById('userRoom');
    const userClassElem = document.getElementById('userClass');
    const userAddressElem = document.getElementById('userAddress');
    const visitLeftElem = document.getElementById('visitLeft');
    const visitListElem = document.getElementById('visitList');
    const userBalanceElem = document.getElementById('userBalance');
    const scheduleListElem = document.getElementById('scheduleList');
    const countdownTimer = document.getElementById('countdownTimer');
    const cdHours = document.getElementById('cdHours');
    const cdMinutes = document.getElementById('cdMinutes');
    const cdSeconds = document.getElementById('cdSeconds');
    const cdMs = document.getElementById('cdMs');

    // Login process
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      loginError.style.display = 'none';
      const username = loginForm.username.value.trim();
      const password = loginForm.password.value.trim();

      const user = users.find(u => u.username === username && u.password === password);
      if (user) {
        // Show dashboard and populate data
        populateDashboard(user);
        loginPage.style.display = 'none';
        dashboardPage.style.display = 'block';
        loginForm.reset();
        loginError.style.display = 'none';
      } else {
        loginError.textContent = 'Nama pengguna atau kata sandi salah.';
        loginError.style.display = 'block';
      }
    });

    logoutBtn.addEventListener('click', () => {
      dashboardPage.style.display = 'none';
      loginPage.style.display = 'flex';
      clearCountdownInterval();
    });

    // Populate dashboard data based on user
    function populateDashboard(user) {
      userFullNameElem.textContent = user.fullName;
      userRoomElem.textContent = user.room;
      userClassElem.textContent = user.userClass;
      userAddressElem.textContent = user.address;
      visitLeftElem.textContent = user.visitsLeft;
      userBalanceElem.textContent = user.balance;

      // Populate visits history list
      visitListElem.innerHTML = '';
      user.visitHistory.forEach((visit, idx) => {
        const li = document.createElement('li');
        li.className = 'visit-item';
        li.setAttribute('tabindex', '0');
        li.textContent = `${idx + 1}. ${visit.date} `;
        const spanTime = document.createElement('span');
        spanTime.textContent = visit.time;
        li.appendChild(spanTime);
        visitListElem.appendChild(li);
      });

      // Populate schedule list
      scheduleListElem.innerHTML = '';
      user.schedule.forEach((item, idx) => {
        const li = document.createElement('li');
        li.className = 'schedule-item';
        if(idx === 0) {
          li.classList.add('active');
        }
        li.setAttribute('tabindex', '0');
        const timeSpan = document.createElement('span');
        timeSpan.className = 'time';
        timeSpan.textContent = item.time;
        li.appendChild(timeSpan);
        li.appendChild(document.createTextNode(item.activity));
        scheduleListElem.appendChild(li);
      });

      startCountdown(user.schedule[0].time);
    }

    // Countdown timer to next activity
    let countdownInterval = null;

    function parseTimeToDate(timeStr) {
      // timeStr format HH:mm (24h)
      const [h, m] = timeStr.split(':').map(Number);
      const now = new Date();
      let next = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, 0, 0);
      if(next < now) {
        next.setDate(next.getDate() + 1); // next day
      }
      return next;
    }

    function startCountdown(targetTimeStr) {
      clearCountdownInterval();
      const target = parseTimeToDate(targetTimeStr);
      countdownInterval = setInterval(() => {
        const now = new Date();
        const diff = target - now;

        if (diff <= 0) {
          clearCountdownInterval();
          cdHours.textContent = '0';
          cdMinutes.textContent = '0';
          cdSeconds.textContent = '0';
          cdMs.textContent = '00';
          return;
        }

        const hours = Math.floor(diff / 3600000);
        const minutes = Math.floor((diff % 3600000) / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);
        const milliseconds = Math.floor((diff % 1000) / 10);

        cdHours.textContent = hours.toString();
        cdMinutes.textContent = minutes.toString().padStart(2, '0');
        cdSeconds.textContent = seconds.toString().padStart(2, '0');
        cdMs.textContent = milliseconds.toString().padStart(2, '0');
      }, 100);
    }
    function clearCountdownInterval() {
      if(countdownInterval) {
        clearInterval(countdownInterval);
        countdownInterval = null;
      }
    }

    // Accessible toggle sidebar menu (optional)
    // This example does not fully implement a side menu that collapses because the sidebar is fixed narrow,
    // but I added a toggle button as placeholder for future expansion or mobile menu integration
    const menuToggle = document.getElementById('menuToggle');
    menuToggle.addEventListener('click', () => {
      alert('Menu toggle clicked. Sidebar can be enhanced further.');
    });

    // Additional UI handlers for Selengkapnya (can be expanded)
    document.getElementById('moreSchedule').addEventListener('click', () => {
      alert('Fitur selengkapnya untuk kegiatan hari ini belum tersedia.');
    });
    document.getElementById('moreVisits').addEventListener('click', () => {
      alert('Fitur selengkapnya untuk riwayat kunjungan belum tersedia.');
    });

  </script>
</body>
</html>

