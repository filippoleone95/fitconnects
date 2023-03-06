<!--Modal inserimento-->
<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textModal">Attenzione!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <div class="input-group input-group-outline my-3">
          <label class="form-label">Codice</label>
          <input type="text" id="code" name="code" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" onclick="add()">Aggiungi</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

      </div>
    </div>
  </div>
</div>

<!--Modal messaggio-->
<div class="modal fade"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalMessage">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Attenzione!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="textModal2"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        
      </div>
    </div>
  </div>
</div>
