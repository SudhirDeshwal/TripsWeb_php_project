<form method="post" action="booking.php">
    <input type="hidden" name="tripid" value="<?= $trip['trip_id']; ?>">
    <div class="form-group">
        <label for="email">Logged in as:</label>
        <input type="text" readonly class="form-control-plaintext" id="email" value="<?= $_SESSION['email']; ?>" name="email">
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="adults">Number of Adults:</label>
                <select onchange="calcCost()" class="form-control selectwidthauto" id="adults" name="adults">
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group ">
                <label for="children">Number of Children:</label>
                <select onchange="calcCost()" class="form-control selectwidthauto" id="children" name="children">
                    <option value="0" selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="notes">Aditional Notes:</label>
        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="cost">Total Cost is:</label>
        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="cost" value="0.00" name="cost">
    </div>
    <input type="hidden" name="costtotal" id="costtotal" value="0.00">
    <button type="submit" name="book_trip" value="book_trip" class="btn btn-success mb-2">Confirm Booking</button>
</form>

<script>
    window.onload = calcCost();

    function calcCost() {
        var eAdults = document.getElementById("adults");
        var adults = eAdults.options[eAdults.selectedIndex].value;

        var eChild = document.getElementById("children");
        var children = eChild.options[eChild.selectedIndex].value;

        var total = (<?= $trip['cost']; ?> * adults) + (<?= $trip['cost']; ?> * 0.5 * children)

        document.getElementById("costtotal").value = total;
        document.getElementById("cost").value = '$' + Number(total).toLocaleString();
    }
</script>