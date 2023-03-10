<!-- Modal generico avvisi-->

<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
  <div class="modal-dialog " id="modalDialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="label">Attenzione!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="textModal">
        <form class="text-start"></form>
      </div>
      <div id="mod_foot" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

      </div>
    </div>
  </div>
</div>

<!-- Modal info esercizio scheda -->
<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalInfoEs">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelInfo">Avviso</h5>
        <button type="button" class="btn btn-link " data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-x"></i>
        </button>
      </div>
      <div class="modal-body" id="infoSpace">

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal aggiunta modifica risultati -->
<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalRisultati">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelRisultati">Nuovo risultato</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form autocomplete="off" method="POST" class="text-start" id="form-data">

          <div class="input-group input-group-outline my-3  is-filled">
            <label class="form-label">Risultato</label>
            <input type="text" id="quantita" name="quantita" class="form-control">
          </div>

          <div class="input-group input-group-outline my-3  is-filled">
            <label class="form-label">Unita di misura</label>
            <select class="form-select form-control" id="misura" name="misura">
              <option value="m">Metri</option>
              <option value="kg">Kg</option>
              <option value="min">Minuti</option>
              <option value="ore">Ore</option>
              <option value="ripetizioni">ripetizioni</option>
            </select>
          </div>


          <input type="hidden" id="ide" name="ide" value="" />
          <input type="hidden" id="userR" name="userR" value="addRis" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="saveRis">Salva</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
      </div>
    </div>
  </div>
</div>

<?php if ($base == "Dashboard" && $Istruttore) { ?>
  <!-- Modal aggiunta modifica news -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalNews">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelNews"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data-news">

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Titolo</label>
              <input type="text" id="title" name="title" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Corpo Notizia</label>
              <textarea type="text" id="corpo" name="corpo" class="form-control" style="height: 100px"></textarea>
            </div>


            <input type="hidden" id="idn" name="idn" value="" />
            <input type="hidden" id="user" name="user" value="newNews" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveNews()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>


<?php }
if ($base == "Profilo") { ?>
  <!-- Modal info profilo-->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalProfilo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelP"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start">
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Nome</label>
              <input type="text" id="nome" name="nome" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Cognome</label>
              <input type="text" id="cognome" name="cognome" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Data Nascita</label>
              <input type="date" id="data_n" name="data_n" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Indirizzo</label>
              <input type="text" id="ind" name="ind" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Sesso</label>
              <select class="form-select form-control" id="sesso" name="sesso">
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
                <option value="T">Altro</option>
              </select>
            </div>
            <input type="hidden" id="user" name="user" value="updateProf" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="salva()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal immagine profilo-->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalImg">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelImg"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-outline my-3  is-filled">
            <label for="formFile" class="form-label">Carica immagine del profilo</label>
            <input class="form-control" type="file" accept="image/*" id="imageProf" style="padding: 0.55rem 0.75rem !important;">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="loadBtn">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal numero di telefono-->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalNum">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelNum"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="input-group input-group-outline my-3  is-filled">
            <label for="formFile" class="form-label">Numero di telefono</label>
            <input class="form-control" type="number" id="phone" maxlength="10">
          </div>
        </div>
        <button type="button" class="btn btn-danger mx-3" id="btnDelNum" onclick="saveNum(0)">Elimna numero</button>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveNum(1)">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>
<?php }
if (isset($Prog) && $Prog == false) { ?>
  <!-- Modal Iniziali -->

  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalProgressi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelPr"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start">
            <div class="input-group input-group-outline my-3  ">
              <label class="form-label">Quanto pesi attualmente?</label>
              <input type="number" id="peso" name="peso" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 ">
              <label class="form-label">Quanto vorresti pesare?</label>
              <input type="number" id="pesoD" name="pesoD" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 ">
              <label class="form-label">Quanto sei alto ? (Esprimere in cm , es. 170 cm)</label>
              <input type="number" id="altezza" name="altezza" class="form-control">
            </div>
            <input type="hidden" id="userP" name="userP" value="updateProg" />
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalProgressi2" data-bs-dismiss="modal" data-bs-toggle="modal">Continua</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal iniziale aggiunta informazioni sugli obbiettivi -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalProgressi2">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelPr2"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start">
            <div class="input-group input-group-outline my-3  ">
              <label class="form-label">Quante volte a settimana vorresti allenarti?</label>
              <input type="number" id="allenamento" name="allenamento" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 ">
              <label class="form-label">Da quanto tempo non pratichi attività fisica?</label>
              <input type="text" id="ultimo" name="ultimo" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3 ">
              <label class="form-label">Qual è stato l'ultimo sport che hai effettuato assiduamente?</label>
              <input type="text" id="ultimos" name="ultimos" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Qual è il tuo obiettivo ?</label>
              <select class="form-select form-control" id="obiettivo" name="obiettivo">
                <option value="Dimagrire">Dimagrire</option>
                <option value="Aumentare massa magra">Aumentare massa magra</option>
                <option value="Definire">Definire</option>
                <option value="Aumentare la resistenza">Aumentare la resistenza</option>
                <option value="Migliorare l'agilità">Migliorare l'agilità</option>
                <option value="Altro">Altro</option>
              </select>
            </div>
            <input type="hidden" id="userP" name="userP" value="updateProg" />
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#modalProgressi3" data-bs-dismiss="modal" data-bs-toggle="modal">Continua</button>
          <button type="button" class="btn btn-secondary" data-bs-target="#modalProgressi" data-bs-dismiss="modal" data-bs-toggle="modal">Torna indietro</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal iniziale aggiunta allenatori preferiti -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalProgressi3">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelPr3"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start">

            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Scegli il tuo allenatore preferito</label>
              <select class="form-select form-control" id="istruttore" name="istruttore">
                <?php
                echo "<option value=\"NULL\">Nessuna preferenza</option>";
                foreach ($Istruttori as $row) {
                  $p = $Profilo->getProfiloFromId($row["id"], $db);
                  echo "<option value=\"" . $row["id"] . "\">" .  $p["nome"] . " " . $p["cognome"] . "</option>";
                }
                ?>
              </select>
            </div>


            <input type="hidden" id="userP" name="userP" value="updateProg" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="salvaProg()">Invia richiesta prima scheda</button>
          <button class="btn btn-secondary" data-bs-target="#modalProgressi2" data-bs-dismiss="modal" data-bs-toggle="modal">Torna indietro</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Fine Modal Iniziali -->


<?php }
if ($base == "Profilo" && isset($Prog) && $Prog == true) { ?>

  <!-- Modal aggiunta modifica progressi -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalProgressi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelPr"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start">
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">La tua altezza in cm</label>
              <input type="number" id="altezza" name="altezza" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Peso inserito all' inizio</label>
              <input type="number" id="pesoI" name="pesoI" class="form-control" disabled>
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Peso desiderato</label>
              <input type="number" id="pesoD" name="pesoD" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Peso attuale</label>
              <input type="number" id="pesoF" name="pesoF" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Quante volte a settimana vorresti allenarti?</label>
              <input type="number" id="allenamento" name="allenamento" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Da quanto tempo non pratichi attività fisica?</label>
              <input type="text" id="ultimo" name="ultimo" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Qual è stato l'ultimo sport che hai effettuato assiduamente?</label>
              <input type="text" id="ultimos" name="ultimos" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Qual è il tuo obiettivo ?</label>
              <select class="form-select form-control" id="obiettivo" name="obiettivo">
                <option value="Dimagrire">Dimagrire</option>
                <option value="Aumentare massa magra">Aumentare massa magra</option>
                <option value="Definire">Definire</option>
                <option value="Aumentare la resistenza">Aumentare la resistenza</option>
                <option value="Migliorare l'agilità">Migliorare l'agilità</option>
                <option value="Altro">Altro</option>
              </select>
            </div>


            <input type="hidden" id="userP" name="userP" value="updateProg2" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="salva2()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>
<?php }
if ($base == "Esercizi") { ?>
  <!-- Modal aggiunta modifica gruppo muscolare -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalGroup">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelGroup"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data-gr">
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Nome gruppo</label>
              <input type="text" id="nome" name="nome" class="form-control">
            </div>

            <input type="hidden" id="id" name="id" value="" />
            <input type="hidden" id="user" name="user" value="newGrup" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveGr()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data-gr').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal aggiunta modifica esercizio -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalEs">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelEs"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data">

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Nome Esercizio</label>
              <input type="text" id="nomeEs" name="nomeEs" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Descrizione Esercizio</label>
              <textarea type="text" id="desc" name="desc" class="form-control" style="height: 100px"></textarea>
            </div>
            <div class="row align-items-center">
              <div class="col-10">
                <div class="input-group input-group-outline my-3 is-filled">
                  <label class="form-label">Codice video esercizio (YouTube)</label>
                  <input type="text" id="code" name="code" class="form-control">
                </div>
              </div>

              <div class="col-2">
                <button style="margin:0px; " type="button" class="btn btn-secondary" onclick="info()">?</button>
              </div>
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label for="formFile" class="form-label">Carica immagini per esercizio</label>

              <input class="form-control" id="images" type="file" accept="image/*" multiple="multiple" style="padding: 0.55rem 0.75rem !important;">
            </div>
            <input type="hidden" id="id2" name="id2" value="" />
            <input type="hidden" id="user2" name="user2" value="newEs" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="saveEs()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

<?php }
if ($base == "Scheda") { ?>

  <!-- Modal aggiunta modifica scheda -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalScheda">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelScheda"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data">

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Nome scheda</label>
              <input type="text" id="nome" name="nome" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Data inizio</label>
              <input type="date" id="dataI" name="dataI" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Data scadenza</label>
              <input type="date" id="dataS" name="dataS" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="attiva">
                <label class="form-check-label" for="attiva">Attiva (spuntare per rendere la scheda visibile all'atleta)</label>
              </div>
            </div>

            <input type="hidden" id="idu" name="idu" value="" />
            <input type="hidden" id="idS" name="idS" value="" />
            <input type="hidden" id="user" name="user" value="newScheda" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveScheda()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal aggiunta esercizio in  scheda -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalEsScheda">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelEsInScheda"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data-gr">
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label" for="gruppo">Seleziona gruppo</label>
              <select class="form-select form-control" id="gruppo" name="gruppo">
                <?php
                foreach ($Gruppi->getGruppi($db) as $g) {
                  echo "<option value=\"" . $g["id_gruppo"] . "\">" . $g["nome_gruppo"] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label" for="es">Seleziona esercizio</label>
              <select class="form-select form-control" id="es" name="es">

              </select>
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Serie</label>
              <input type="number" id="serie" name="serie" class="form-control">
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Ripetizioni</label>
              <input type="number" id="ripetizioni" name="ripetizioni" class="form-control">
            </div>
            <div class="container-fluid py-4" style="z-index: 1000;">
              <input type="hidden" id="idScheda" name="idScheda" value="" />
              <input type="hidden" id="user" name="user" value="newGrup" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnAddEs" onclick="saveEs()">Aggiungi</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data-gr').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal info schede scadute -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalScad">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelScad">Schede scadute</h5>
          <button type="button" class="btn btn-link " data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-x"></i>
          </button>
        </div>
        <div class="modal-body" id="scadSpace">
          <div class="table-responsive p-0 " style="height: 200px; max-height: 250px;">
            <table class="table align-items-center table-danger table-striped justify-content-center mb-0 max-height-vh-100">
              <thead>
                <tr>
                  <th class="text-center">Scheda</th>
                  <th class="text-center">Data inizio scheda</th>
                  <th class="text-center">Data scadenza scheda</th>
                  <th class="text-center">Atleta</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($Scheda->getSchedeScadute($db) as $s) {
                ?>
                  <tr style="cursor: pointer;">

                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $s['id_user'] ?>')"><?= $s["nome_scheda"] ?></td>
                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $s['id_user'] ?>')"><?= date("d/m/Y", strtotime($s["data_inizio"])) ?></td>
                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $s['id_user'] ?>')"><?= date("d/m/Y", strtotime($s["data_scadenza"])) ?></td>
                    <td class="text-center" onclick="window.location.replace('../Public/Scheda?atl=<?= $s['id_user'] ?>')"><?php $p = $Profilo->getProfiloFromId($s['id_user'], $db);
                                                                                                                            echo $p["nome"] . " " . $p["cognome"]; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal aggiunta modifica scheda -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalSchedaB">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelSchedaB"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data">

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Nome scheda</label>
              <input type="text" id="nome_b" name="nome_b" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Anni min</label>
              <input type="number" id="amin" name="amin" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Anni max</label>
              <input type="number" id="amax" name="amax" class="form-control">
            </div>

            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Sesso consigliato</label>
              <select class="form-select form-control" id="sex" name="sex">
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
                <option value="T">Tutti</option>
              </select>
            </div>


            <input type="hidden" id="idS" name="idS" value="" />
            <input type="hidden" id="userB" name="userB" value="newSchedaB" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveSchedaB()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal aggiunta modifica scheda -->
  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalModReq">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelReq"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form autocomplete="off" method="POST" class="text-start" id="form-data">

            <div class="input-group input-group-outline my-3 is-filled">
              <label class="form-label">Scegli l' allenatore </label>
              <select class="form-select form-control" id="istruttore" name="istruttore">
                <?php
                echo "<option value=\"\">Nessuna preferenza</option>";
                foreach ($Istruttori as $row) {
                  echo "<option value=\"" . $row["id"] . "\">" . $row["email"] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="input-group input-group-outline my-3  is-filled">
              <label class="form-label">Note ed eventuali richieste</label>
              <textarea type="text" id="note" name="note" class="form-control" style="height: 100px ;padding: 0.5rem 0.5rem !important;"></textarea>
            </div>

            <input type="hidden" id="idi" name="idi" value="" />
            <input type="hidden" id="idS" name="idS" value="" />
            <input type="hidden" id="userB" name="userB" value="changeSch" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="sendReq()">Salva</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="$('#form-data').trigger('reset');">Chiudi</button>
        </div>
      </div>
    </div>
  </div>



<?php }
if ($base == "Allenamento") { ?>

  <!-- Modal allenamento -->

  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalAll">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelAll">Attenzione</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="textModalAll">
          <form class="text-start"></form>
        </div>
        <div id="mod_foot_all" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeBtn">Chiudi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal utility-->

  <div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modalUt">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="labelUt">Attenzione!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="textModalUt">
          <form class="text-start">
            <div class="row">
              <div class="col-6">
                <div class="input-group input-group-outline my-3  is-filled">
                  <label class="form-label">Minuti</label>
                  <input type="number" id="min" name="min" max="99" required value="0" maxlength="2" class="form-control">
                </div>
              </div>
              <div class="col-6">
                <div class="input-group input-group-outline my-3  is-filled">
                  <label class="form-label">Secondi</label>
                  <input type="number" id="sec" name="sec" max="59" required value="0" maxlength="2" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div id="mod_foot_ut" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

        </div>
      </div>
    </div>
  </div>

<?php } ?>