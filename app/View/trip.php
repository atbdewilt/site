<div class="container">
    <div class="ui-widget">
        <form action="/site/Trip/" method="POST">
            <input type="hidden"
                id="station1_id"
                name="station1_id"
                value="<?= $_POST['station1_id'] ?? null ?>">
            <input type="text"
                id="station1_name"
                name="station1_name"
                placeholder="Vertrekpunt"
                value="<?= $_POST['station1_name'] ?? null ?>">

            <input type="hidden"
                id="station2_id"
                name="station2_id"
                value="<?= $_POST['station2_id'] ?? null ?>">
            <input type="text"
                id="station2_name"
                name="station2_name"
                placeholder="Bestemming"
                value="<?= $_POST['station2_name'] ?? null ?>">

            <button>Go!</button>
        </form>
    </div>

    <?php if (isset($this->response) && isset($this->response->trips)) {
        // Spit out the trip result
        echo \app\Utility\NSAPI::htmlTrip($this->response->trips);
    } ?>
</div>

<script>var stations = <?= json_encode($this->stations) ?></script>