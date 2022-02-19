<div class="container">
    <div class="row gx-5">
        <div class="col">
            <div class="ui-widget">
                <form action="/site/Station/" method="POST">
                    <input type="hidden"
                        id="station1_id"
                        name="station1_id"
                        value="<?= $_POST['station1_id'] ?? null ?>">
                    <input type="text"
                        id="station1_name"
                        name="station1_name"
                        placeholder="Kies station"
                        value="<?= $_POST['station1_name'] ?? null ?>">

                    <button>Go!</button>
                </form>
            </div>
        </div>
    </div>
<?php if (isset($this->response) && $this->response !== false): ?>
    <div class="row">
        <!-- Arrivals -->
        <div class="col">
            <p class="mt-5">Er komen <?= count($this->response['arrivals']->payload->arrivals) ?> treinen aan.</p>
            <?php $i=0; foreach ($this->response['arrivals']->payload->arrivals as $arrival): $i++; ?>
            <div class="table mt-5">
                <h4>Arrival: <?= $i ?></h4>
                <table class="table">
                    <tr>
                        <th>origin</th>
                        <td><?= $arrival->origin ?></td>
                    </tr>
                    <tr>
                        <th>name</th>
                        <td><?= $arrival->name ?></td>
                    </tr>
                    <tr>
                        <th>plannedDateTime</th>
                        <td><?= \app\Utility\NSAPI::convertToDateTime($arrival->plannedDateTime) ?></td>
                    </tr>
                    <tr>
                        <th>actualDateTime</th>
                        <td><?= \app\Utility\NSAPI::convertToDateTime($arrival->actualDateTime) ?></td>
                    </tr>
                    <tr>
                        <th>plannedTrack</th>
                        <td><?= $arrival->plannedTrack ?></td>
                    </tr>
                    <tr>
                        <th>product</th>
                        <td><?= $arrival->product->shortCategoryName . ' ' . $arrival->product->number ?></td>
                    </tr>
                    <tr>
                        <th>trainCategory</th>
                        <td><?= $arrival->trainCategory ?></td>
                    </tr>
                    <tr>
                        <th>cancelled</th>
                        <td><?= (($arrival->cancelled) === true) ? "True" : "False" ?></td>
                    </tr>
                    <tr>
                        <th>messages</th>
                        <td><?php if (isset($arrival->messages) && !empty($arrival->messages)): ?>
                            <ul><?php foreach ($arrival->messages as $item): ?>
                                <li><?= $item->message ?></li>
                            <?php endforeach; ?></ul>
                        <?php endif; ?></td>
                    </tr>
                    <tr>
                        <th>arrivalStatus</th>
                        <td><?= $arrival->arrivalStatus ?></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Departures -->
        <div class="col-*-6">
            <p class="mt-5">Er vertrekken <?= count($this->response['departures']->payload->departures) ?> treinen.</p>
            <?php $i=0; foreach ($this->response['departures']->payload->departures as $departure): $i++; ?>
            <div class="table mt-5">
                <h4>Departure: <?= $i ?></h4>
                <table class="table">
                    <tr>
                        <th>direction</th>
                        <td><?= $departure->direction ?></td>
                    </tr>
                    <tr>
                        <th>name</th>
                        <td><?= $departure->name ?></td>
                    </tr>
                    <tr>
                        <th>plannedDateTime</th>
                        <td><?= \app\Utility\NSAPI::convertToDateTime($departure->plannedDateTime) ?></td>
                    </tr>
                    <tr>
                        <th>actualDateTime</th>
                        <td><?= \app\Utility\NSAPI::convertToDateTime($departure->actualDateTime) ?></td>
                    </tr>
                    <tr>
                        <th>plannedTrack</th>
                        <td><?= $departure->plannedTrack ?></td>
                    </tr>
                    <tr>
                        <th>product</th>
                        <td><?= $departure->product->shortCategoryName . ' ' . $departure->product->number ?></td>
                    </tr>
                    <tr>
                        <th>trainCategory</th>
                        <td><?= $departure->trainCategory ?></td>
                    </tr>
                    <tr>
                        <th>cancelled</th>
                        <td><?= (($departure->cancelled) === true) ? "True" : "False" ?></td>
                    </tr>
                    <tr>
                        <th>messages</th>
                        <td><?php if (isset($departure->messages) && !empty($departure->messages)): ?>
                            <ul><?php foreach ($departure->messages as $item): ?>
                                <li><?= $item->message ?></li>
                            <?php endforeach; ?></ul>
                        <?php endif; ?></td>
                    </tr>
                    <tr>
                        <th>departureStatus</th>
                        <td><?= $departure->departureStatus ?></td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
</div>

<script>var stations = <?= json_encode($this->stations) ?></script>