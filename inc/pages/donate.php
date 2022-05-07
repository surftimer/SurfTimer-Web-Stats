<?php if($steam->loggedIn()): ?>

    
<div class="modal fade" id="donate-modal" tabindex="-1" aria-labelledby="donate-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title" id="donate-modal-label">Surf Community <small>DONATION</small></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="mb-3 text-center">Select options</h5>
                    <div id="smart-button-container">
                    <select class="form-control" id="item-options">
                        <option value="Donation - Tier 1 (1 Month)" price="2">Tier 1 (1 Month) - 2.00 EUR</option>
                        <option value="Donation - Tier 2 (1 Month)" price="4">Tier 2 (1 Month) - 4.00 EUR</option>
                        <option value="Donation - Tier 2 (3 Months)" price="9">Tier 2 (3 Months) - 9.00 EUR</option>
                        <option value="Donation - Tier 3 (1 Month)" price="8">Tier 3 (1 Month) - 8.00 EUR</option>
                        <option value="Donation - Tier 3 (3 Months)" price="18">Tier 3 (3 Months) - 18.00 EUR</option>
                        <option value="Donation - Lifetime Tier (Lifetime)" price="60">Lifetime Tier (Lifetime) - 60.00 EUR</span></option>
                    </select>
                    <div class="form-check text-center my-3">
                        <input class="form-check-input" type="radio" name="steam_id" value="<?php echo $user_communityid; ?>" checked>
                        <label class="form-check-label" for="duration">
                            Award to myself (<?php echo $steam->personaname; ?>)
                        </label>
                    </div>
                </div>
                <div class="px-2 my-2" id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=AXBYasrucUuCYkwOKMksjQiLXghnFERYhR-u3NRKq-CAx9I82NrVk7tNqL4tnFq83WIl0RSsO4gnHElr&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
        function initPayPalButton() {
            var shipping = 0;
            var itemOptions = document.querySelector("#smart-button-container #item-options");
            
            var orderDescription = 'Donate Surf Community';
            if(orderDescription === '') {
                orderDescription = 'Item';
            }
            paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'blue',
                layout: 'horizontal',
                label: 'checkout',
                
            },
            createOrder: function(data, actions) {
                var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
                var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
                var tax = (0 === 0) ? 0 : (selectedItemPrice * (parseFloat(0)/100));

                tax = Math.round(tax * 100) / 100;
                var priceTotal = selectedItemPrice + parseFloat(shipping) + tax;
                priceTotal = Math.round(priceTotal * 100) / 100;
                var itemTotalValue = Math.round((selectedItemPrice) * 100) / 100;

                return actions.order.create({
                purchase_units: [{
                    description: orderDescription,
                    custom_id: '<?php echo $user_communityid; ?>',
                    amount: {
                    currency_code: 'EUR',
                    value: priceTotal,
                    breakdown: {
                        item_total: {
                        currency_code: 'EUR',
                        value: itemTotalValue
                        }
                    }
                    },
                    items: [{
                    name: selectedItemDescription,
                    unit_amount: {
                        currency_code: 'EUR',
                        value: selectedItemPrice,
                    },
                    quantity: 1
                    }]
                }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                window.location.replace("donate-old.php");
                console.log(details);
                });
            },
            onError: function(err) {
                console.log(err);
            },
            }).render('#paypal-button-container');
        }
        initPayPalButton();
        </script>

            </div>
        </div>
    </div>
</div>


<?php endif; ?>