<!DOCTYPE html>
<html lang="en">
<head>
  <title>VSU Auction Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(-45deg, #002D72, #FF6A13, #0050a5, #FFA14B);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .form-container {
      position: relative;
      width: 420px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 40px 30px;
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: 0.5s ease;
    }

    .vsu-logo {
      display: block;
      width: 70px;
      margin: 0 auto 20px;
    }

    h3 {
  background: white;
  color: #002D72;
  padding: 12px 20px;
  border-radius: 10px;
  font-weight: 700;
  width: fit-content;
  margin: 0 auto 20px;
  text-align: center;
}

    p {
      text-align: center;
      color: white;
      font-size: 14px;
      margin-bottom: 20px;
    }

    label {
      color: white;
      font-size: 15px;
      margin-top: 10px;
      display: block;
    }

    input {
      width: 100%;
      height: 45px;
      margin-top: 5px;
      border: none;
      border-radius: 8px;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 0 10px;
      color: white;
    }

    input::placeholder {
      color: #ccc;
    }

    .toggle-password {
      float: right;
      margin-top: -30px;
      margin-right: 10px;
      cursor: pointer;
      color: #FFA14B;
    }

    button {
      width: 100%;
      margin-top: 25px;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background-color: #FF6A13;
      color: white;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease;
    }

    button:hover {
      background-color: #e25c10;
    }

    .switch-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: white;
    }

    .switch-link a {
      color: #FFA14B;
      cursor: pointer;
      font-weight: bold;
    }

    .form-section {
      display: none;
    }

    .form-section.active {
      display: block;
      animation: fadeSlide 0.4s ease forwards;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .toast {
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      background: #00cc88;
      color: white;
      padding: 15px 25px;
      border-radius: 5px;
      display: none;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .error-message {
      font-size: 13px;
      color: #ffbbbb;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  

    <div id="login" class="form-section active">
      <h3>VSU Auction Login</h3>
      <p>Trojan Pride </p>

      <label for="login-email">Email</label>
      <input type="text" id="login-email" placeholder="Email or Phone">

      <label for="login-pass">Password</label>
      <input type="password" id="login-pass" placeholder="Password">
      <i class="fas fa-eye toggle-password" onclick="togglePassword('login-pass')"></i>

      <button>Log In</button>

      <div class="switch-link">
        Don't have an account? <a onclick="switchForm('register')">Create one</a>
      </div>
    </div>

    <div id="register" class="form-section">
      <h3>Create Your VSU Account</h3>
      <p>Use your official @vsu.edu email</p>

      <label for="reg-email">VSU Email</label>
      <input type="email" id="reg-email" placeholder="yourname@vsu.edu">

      <label for="reg-pass">Password</label>
      <input type="password" id="reg-pass" placeholder="Create a password">
      <i class="fas fa-eye toggle-password" onclick="togglePassword('reg-pass')"></i>

      <div id="error-msg" class="error-message"></div>

      <button onclick="validateVSUEmail()">Create Account</button>

      <div class="switch-link">
        Already have an account? <a onclick="switchForm('login')">Back to login</a>
      </div>
    </div>
  </div>

  <div id="toast" class="toast">Account created successfully!</div>

  <script>
    function switchForm(id) {
      document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
      });
      document.getElementById(id).classList.add('active');
      document.getElementById('error-msg').innerText = '';
    }

    function togglePassword(fieldId) {
      const input = document.getElementById(fieldId);
      input.type = input.type === 'password' ? 'text' : 'password';
    }

    function validateVSUEmail() {
      const email = document.getElementById('reg-email').value.trim();
      const errorBox = document.getElementById('error-msg');

      if (!email.endsWith('@vsu.edu')) {
        errorBox.innerText = 'Please use your Virginia State University email.';
        return;
      }

      errorBox.innerText = '';
      showToast('Account created successfully!');
      switchForm('login');
    }

    function showToast(message) {
      const toast = document.getElementById('toast');
      toast.innerText = message;
      toast.style.display = 'block';

      setTimeout(() => {
        toast.style.display = 'none';
      }, 3000);
    }
  </script>
</body>
</html>
