<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet | EkSeat.com</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #333;
            line-height: 1.6;
            padding: 30px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }
        
        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header {
            text-align: center;
            margin-bottom: 50px;
            padding-top: 20px;
            width: 100%;
        }
        
        .logo {
            font-size: 42px;
            font-weight: 800;
            color: #84a8c6;
            margin-bottom: 10px;
            letter-spacing: -1px;
            position: relative;
            display: inline-block;
        }
        
        .logo::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 10%;
            width: 80%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #000, transparent);
        }
        
        .tagline {
            color: #84a8c6;
            font-size: 16px;
            font-weight: 500;
            margin-top: 15px;
        }
        
        .balance-card {
            background: linear-gradient(135deg, #2c2c2c 0%, #3a3a3a 100%);
            border-radius: 25px;
            padding: 45px 40px;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            color: #f0f0f0;
            width: 100%;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: cardFloat 6s ease-in-out infinite;
        }
        
        @keyframes cardFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .balance-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }
        
        .balance-card::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 8s infinite linear;
        }
        
        .balance-card::after {
            content: "";
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 6s infinite linear reverse;
        }
        
        @keyframes pulse {
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.3; }
            100% { transform: scale(0.8); opacity: 0.5; }
        }
        
        .balance-title {
            font-size: 18px;
            color: #bbb;
            margin-bottom: 15px;
            font-weight: 500;
            letter-spacing: 1px;
        }
        
        .balance-amount {
            font-size: 52px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
        }
        
        .currency {
            font-size: 32px;
            margin-right: 12px;
            color: #ddd;
        }
        
        .section-title {
            font-size: 26px;
            font-weight: 700;
            margin: 50px 0 25px 0;
            color: #000;
            width: 100%;
            position: relative;
            padding-left: 15px;
        }
        
        .section-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 5px;
            background: linear-gradient(to bottom, #84a8c6, #00ccff);
            border-radius: 5px;
        }
        
        .payment-methods {
            background: #ffffff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            margin-bottom: 40px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .payment-methods:hover {
            transform: translateY(-5px);
        }
        
        .payment-header {
            padding: 30px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .payment-title {
            font-size: 22px;
            font-weight: 600;
            color: #000;
        }
        
        .payment-count {
            background: rgba(51, 102, 255, 0.1);
            color: #3366ff;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .add-payment-method {
            display: flex;
            align-items: center;
            padding: 35px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 120px;
            position: relative;
            overflow: hidden;
        }
        
        .add-payment-method::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 0, 0, 0.02), transparent);
            transition: left 0.6s ease;
        }
        
        .add-payment-method:hover::before {
            left: 100%;
        }
        
        .add-payment-method:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .add-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #84a8c6 0%, #84a8c6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(51, 102, 255, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 1;
        }
        
        .add-payment-method:hover .add-icon {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 8px 20px rgba(51, 102, 255, 0.4);
        }
        
        .add-text {
            font-size: 22px;
            color: #000;
            font-weight: 600;
            z-index: 1;
        }
        
        .add-description {
            font-size: 16px;
            color: #666;
            margin-top: 8px;
            z-index: 1;
        }
        
        .footer {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 15px;
            width: 100%;
            padding: 25px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .security-note i {
            margin-right: 10px;
            color: #4CAF50;
        }
        
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .floating-element {
            position: absolute;
            background: rgba(0, 0, 0, 0.02);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-100vh) rotate(360deg); }
        }
        
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
            
            .balance-card {
                padding: 35px 30px;
                height: 180px;
            }
            
            .balance-amount {
                font-size: 44px;
            }
            
            .add-payment-method {
                padding: 30px;
                height: 110px;
            }
            
            .add-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <?php include "userNavBar.php";?>
    <div class="floating-elements" id="floatingElements"></div>
    
    <div class="container">
        <div class="header">
            <div class="logo"></div>
            <div class="tagline"></div>
        </div>
        
        <div class="balance-card">
            <div class="balance-title">Total Transaction Amount</div>
            <div class="balance-amount">
                <span class="currency">BDT</span> <span id="transaction-amount">0</span>
            </div>
        </div>
        
        <div class="section-title">Payment Methods</div>
        
        <div class="payment-methods">
            <div class="payment-header">
                <div class="payment-title">Your Payment Methods</div>
                <div class="payment-count">0 methods</div>
            </div>
            
            <div class="add-payment-method">
                <div class="add-icon">+</div>
                <div>
                    <div class="add-text">Add Payment Method</div>
                    <div class="add-description">Credit card, debit card, or digital wallet</div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div>EkSeat.com Technologies Inc.</div>
            <div class="security-note">
                <i class="fas fa-shield-alt"></i>
                Your payment information is secure and encrypted
            </div>
        </div>
    </div>

    <script>
    // PHP value passed to JavaScript
    var userTotalTransaction = <?php echo isset($_COOKIE["user_totalTransaction"]) ? $_COOKIE["user_totalTransaction"] : 0; ?>;

    // Create floating background elements
    const floatingContainer = document.getElementById('floatingElements');
    const colors = ['rgba(51, 102, 255, 0.05)', 'rgba(0, 204, 255, 0.05)', 'rgba(0, 0, 0, 0.02)'];
    
    for (let i = 0; i < 15; i++) {
        const element = document.createElement('div');
        element.classList.add('floating-element');
        
        const size = Math.random() * 100 + 20;
        const color = colors[Math.floor(Math.random() * colors.length)];
        
        element.style.width = `${size}px`;
        element.style.height = `${size}px`;
        element.style.background = color;
        element.style.left = `${Math.random() * 100}vw`;
        element.style.animationDuration = `${Math.random() * 20 + 10}s`;
        element.style.animationDelay = `${Math.random() * 5}s`;
        
        floatingContainer.appendChild(element);
    }
    
    // Add subtle hover effect to the balance card
    const balanceCard = document.querySelector('.balance-card');
    balanceCard.addEventListener('mousemove', (e) => {
        const rect = balanceCard.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const angleY = (x - centerX) / 25;
        const angleX = (centerY - y) / 25;
        
        balanceCard.style.transform = `perspective(1000px) rotateX(${angleX}deg) rotateY(${angleY}deg)`;
    });
    
    balanceCard.addEventListener('mouseleave', () => {
        balanceCard.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
    });
    
    // Counting animation for transaction amount
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = value.toLocaleString();
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    // Start the counting animation when page loads
    window.addEventListener('load', () => {
        const transactionAmount = document.getElementById('transaction-amount');
        animateValue(transactionAmount, 0, userTotalTransaction, 2000);
    });
</script>
</body>
</html>