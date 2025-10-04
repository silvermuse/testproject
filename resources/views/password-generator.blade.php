<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Password Generator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: rgb(47, 47, 112);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        .header-with-home {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #333;
            font-size: 28px;
            flex: 1;
            text-align: center;
        }

        .btn-home-small {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-home-small:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }

        .checkbox-group:hover {
            background: #e9ecef;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            cursor: pointer;
            accent-color: #667eea;
        }

        .checkbox-label {
            color: #333;
            font-size: 16px;
            cursor: pointer;
            user-select: none;
        }

        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-generate {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-generate:active {
            transform: translateY(0);
        }

        .password-result {
            display: none;
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px solid #667eea;
        }

        .password-result.show {
            display: block;
        }

        .password-label {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .password-display {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .password-text {
            flex: 1;
            padding: 12px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            word-break: break-all;
            color: #333;
        }

        .btn-copy {
            padding: 12px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-copy:hover {
            background: #5568d3;
        }

        .error-message {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background: #fee;
            border: 2px solid #fcc;
            border-radius: 8px;
            color: #c33;
        }

        .error-message.show {
            display: block;
        }

        .success-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background: #4caf50;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1000;
        }

        .success-toast.show {
            display: block;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .header-with-home {
                flex-direction: column;
                gap: 15px;
            }

            h1 {
                order: 2;
            }

            .btn-home-small {
                order: 1;
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-with-home">
            <a href="/" class="btn-home-small">
                🏠 Home
            </a>
            <h1>🔐 Password Generator</h1>
            <div style="width: 85px;"></div> <!-- Spacer for centering -->
        </div>
        
        <form id="passwordForm">
            @csrf
            
            <div class="form-group">
                <label>Character Types:</label>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="lowercase" name="include_lowercase" value="1" checked>
                    <label for="lowercase" class="checkbox-label">Lowercase Letters (a-z)</label>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="uppercase" name="include_uppercase" value="1" checked>
                    <label for="uppercase" class="checkbox-label">Uppercase Letters (A-Z)</label>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="numbers" name="include_numbers" value="1" checked>
                    <label for="numbers" class="checkbox-label">Numbers (0-9)</label>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="symbols" name="include_symbols" value="1" checked>
                    <label for="symbols" class="checkbox-label">Symbols (! # $ % & ( ) * + @ ^)</label>
                </div>
            </div>

            <div class="form-group">
                <label for="min_length">Minimum Length:</label>
                <input type="number" id="min_length" name="min_length" value="12" min="4" max="50" required>
            </div>

            <button type="submit" class="btn-generate">Generate Password</button>
        </form>

        <div id="errorMessage" class="error-message"></div>

        <div id="passwordResult" class="password-result">
            <div class="password-label">Generated Password:</div>
            <div class="password-display">
                <div id="passwordText" class="password-text"></div>
                <button type="button" id="copyBtn" class="btn-copy">Copy</button>
            </div>
        </div>
    </div>

    <div id="successToast" class="success-toast">
        Password copied to clipboard!
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('passwordForm');
            const passwordResult = document.getElementById('passwordResult');
            const passwordText = document.getElementById('passwordText');
            const copyBtn = document.getElementById('copyBtn');
            const errorMessage = document.getElementById('errorMessage');
            const successToast = document.getElementById('successToast');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                
                try {
                    const response = await fetch('{{ route("password.generate") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        passwordText.textContent = data.password;
                        passwordResult.classList.add('show');
                        errorMessage.classList.remove('show');
                    } else {
                        errorMessage.textContent = data.message;
                        errorMessage.classList.add('show');
                        passwordResult.classList.remove('show');
                    }
                } catch (error) {
                    errorMessage.textContent = 'An error occurred. Please try again.';
                    errorMessage.classList.add('show');
                    passwordResult.classList.remove('show');
                }
            });

            copyBtn.addEventListener('click', function() {
                const password = passwordText.textContent;
                
                navigator.clipboard.writeText(password).then(function() {
                    successToast.classList.add('show');
                    
                    setTimeout(function() {
                        successToast.classList.remove('show');
                    }, 2000);
                }).catch(function(err) {
                    alert('Failed to copy password');
                });
            });
        });
    </script>
</body>
</html>