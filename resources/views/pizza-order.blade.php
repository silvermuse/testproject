<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pizza Order System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #ff6b6b;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .pizza-items-container {
            margin-bottom: 20px;
        }

        .pizza-item {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin-bottom: 15px;
            position: relative;
        }

        .pizza-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .pizza-number {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }

        .btn-remove {
            background: #ff4444;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-remove:hover {
            background: #cc0000;
            transform: scale(1.05);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 16px;
        }

        select, input[type="number"] {
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        select:focus, input[type="number"]:focus {
            outline: none;
            border-color: #ff6b6b;
        }

        .addons-group {
            margin-top: 15px;
        }

        .addon-option {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .addon-option:hover {
            background: #fffbf0;
            border-color: #ffa500;
        }

        .addon-option input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            cursor: pointer;
            accent-color: #ffa500;
        }

        .addon-option label {
            flex: 1;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .addon-name {
            font-weight: 500;
            color: #333;
        }

        .addon-price {
            color: #ffa500;
            font-weight: 700;
        }

        .addon-disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
        }

        .addon-disabled:hover {
            background: #f8f9fa !important;
            border-color: #e0e0e0 !important;
        }

        .action-buttons {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 20px;
            display: flex;
            gap: 15px;
        }

        .btn-add-pizza {
            flex: 1;
            padding: 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-add-pizza:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-order {
            flex: 2;
            padding: 15px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(255, 107, 107, 0.4);
        }

        .note {
            background: #fff9e6;
            border-left: 4px solid #ffa500;
            padding: 12px 15px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 13px;
            color: #666;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍕 Pizza Order System</h1>
            <p>Add multiple pizzas to your order!</p>
        </div>

        <form id="pizzaForm" method="POST" action="{{ route('pizza.bill') }}">
            @csrf

            <div id="pizzaItemsContainer" class="pizza-items-container">
                <!-- Pizza items will be added here dynamically -->
            </div>

            <div class="action-buttons">
                <button type="button" class="btn-add-pizza" onclick="addPizzaItem()">
                    ➕ Add Another Pizza
                </button>
                <button type="submit" class="btn-order">
                    🛒 Place Order
                </button>
            </div>
        </form>
    </div>

    <script>
        let pizzaCounter = 0;
        const pizzaPrices = @json($pizzaPrices);
        const addonPrices = @json($addonPrices);

        function createPizzaItem() {
            pizzaCounter++;
            const itemDiv = document.createElement('div');
            itemDiv.className = 'pizza-item';
            itemDiv.id = `pizza-item-${pizzaCounter}`;
            
            itemDiv.innerHTML = `
                <div class="pizza-item-header">
                    <div class="pizza-number">${pizzaCounter}</div>
                    ${pizzaCounter > 1 ? `<button type="button" class="btn-remove" onclick="removePizzaItem(${pizzaCounter})">Remove</button>` : ''}
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Pizza Size</label>
                        <select name="pizzas[${pizzaCounter - 1}][size]" class="pizza-size-select" data-index="${pizzaCounter}" required>
                            <option value="">Select Size</option>
                            <option value="small">Small - RM ${parseFloat(pizzaPrices.small.price).toFixed(2)}</option>
                            <option value="medium">Medium - RM ${parseFloat(pizzaPrices.medium.price).toFixed(2)}</option>
                            <option value="large">Large - RM ${parseFloat(pizzaPrices.large.price).toFixed(2)}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="pizzas[${pizzaCounter - 1}][quantity]" value="1" min="1" max="50" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Add-ons (Optional)</label>
                    <div class="addons-group">
                        <div class="addon-option" id="pepperoni-option-${pizzaCounter}">
                            <input type="checkbox" id="pepperoni-${pizzaCounter}" name="pizzas[${pizzaCounter - 1}][addons][]" value="pepperoni">
                            <label for="pepperoni-${pizzaCounter}">
                                <span class="addon-name">
                                    Pepperoni 
                                    <small id="pepperoni-note-${pizzaCounter}">(Select pizza size first)</small>
                                </span>
                                <span class="addon-price" id="pepperoni-price-${pizzaCounter}">+ RM ${parseFloat(addonPrices.pepperoni_small.price).toFixed(2)}</span>
                            </label>
                        </div>

                        <div class="addon-option">
                            <input type="checkbox" id="extra-cheese-${pizzaCounter}" name="pizzas[${pizzaCounter - 1}][addons][]" value="extra_cheese">
                            <label for="extra-cheese-${pizzaCounter}">
                                <span class="addon-name">Extra Cheese</span>
                                <span class="addon-price">+ RM ${parseFloat(addonPrices.extra_cheese.price).toFixed(2)}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="note">
                    <strong>Note:</strong> Pepperoni is only available for Small (RM ${parseFloat(addonPrices.pepperoni_small.price).toFixed(2)}) and Medium (RM ${parseFloat(addonPrices.pepperoni_medium.price).toFixed(2)}) pizzas.
                </div>
            `;

            return itemDiv;
        }

        function addPizzaItem() {
            const container = document.getElementById('pizzaItemsContainer');
            const newItem = createPizzaItem();
            container.appendChild(newItem);
            
            const sizeSelect = newItem.querySelector('.pizza-size-select');
            sizeSelect.addEventListener('change', handleSizeChange);
        }

        function removePizzaItem(itemId) {
            const item = document.getElementById(`pizza-item-${itemId}`);
            if (item) {
                item.remove();
                renumberPizzaItems();
            }
        }

        function renumberPizzaItems() {
            const items = document.querySelectorAll('.pizza-item');
            items.forEach((item, index) => {
                const numberBadge = item.querySelector('.pizza-number');
                if (numberBadge) {
                    numberBadge.textContent = index + 1;
                }
            });
        }

        function handleSizeChange(event) {
            const select = event.target;
            const index = select.dataset.index;
            const selectedSize = select.value;
            
            const pepperoniOption = document.getElementById(`pepperoni-option-${index}`);
            const pepperoniCheckbox = document.getElementById(`pepperoni-${index}`);
            const pepperoniPrice = document.getElementById(`pepperoni-price-${index}`);
            const pepperoniNote = document.getElementById(`pepperoni-note-${index}`);

            if (selectedSize === 'small') {
                pepperoniOption.classList.remove('addon-disabled');
                pepperoniCheckbox.disabled = false;
                pepperoniPrice.textContent = `+ RM ${parseFloat(addonPrices.pepperoni_small.price).toFixed(2)}`;
                pepperoniNote.textContent = '(for Small Pizza)';
            } else if (selectedSize === 'medium') {
                pepperoniOption.classList.remove('addon-disabled');
                pepperoniCheckbox.disabled = false;
                pepperoniPrice.textContent = `+ RM ${parseFloat(addonPrices.pepperoni_medium.price).toFixed(2)}`;
                pepperoniNote.textContent = '(for Medium Pizza)';
            } else if (selectedSize === 'large') {
                pepperoniOption.classList.add('addon-disabled');
                pepperoniCheckbox.disabled = true;
                pepperoniCheckbox.checked = false;
                pepperoniNote.textContent = '(Not available for Large)';
            } else {
                pepperoniOption.classList.add('addon-disabled');
                pepperoniCheckbox.disabled = true;
                pepperoniCheckbox.checked = false;
                pepperoniNote.textContent = '(Select pizza size first)';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            addPizzaItem();

            document.getElementById('pizzaForm').addEventListener('submit', function(e) {
                const pizzaItems = document.querySelectorAll('.pizza-item');
                if (pizzaItems.length === 0) {
                    e.preventDefault();
                    alert('Please add at least one pizza to your order!');
                }
            });
        });
    </script>
</body>
</html>