<div class="row">
    <div class="col-6 px-0">
      <div class="card">
        <div class="card-header bg-success"> Your Score </div>
        <div class="card-body text-center">
          <span id="score" class="display-6 text-danger">0</span>
        </div>
      </div>
    </div>
    <div class="col-6 px-0">
      <div class="card">
        <div class="card-header bg-primary"> Questions </div>
        <div class="card-body text-center">
          <span id="total_items" class="display-6"> {{$items->count()}} </span>
        </div>
      </div>
    </div>
</div>