  <!-- ZONA DE CONTENIDO DINÁ**** TANTO SI HAY USUARIOS COMO SI NO-->
  <div class="row">
      <div class="col-lg-8 mx-auto">
          <p><a href="/registrar">Crear Usuario</a></p>
          <!-- BUCLE SOBRE LOS USUARIOS QUE NOS HAN LLEGADO DEL BACKEND -->
          <?php if (!empty($usuario) && is_array($usuario)) : ?>
              <ul class="list-group shadow">
                  <!-- PARA CADA ZOO... PINTARLO -->
                  <?php foreach ($usuario as $usuario_item) : ?>
                      <li class="list-group-item">
                          <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                              <div class="media-body order-2 order-lg-1">
                                  <h5 class="mt-0 font-weight-bold mb-2"><?= esc($usuario_item['nombre']) ?></h5>
                                  <p class="font-italic text-muted mb-0 small"><?= esc($usuario_item['email']) ?></p>
                                  <a class="btn btn-primary" href="/usuarios/ver/<?= esc($usuario_item['id'], 'url') ?>">Ver</a>

                                  <a class="btn btn-secondary" href="/usuarios/editar/<?= esc($usuario_item['id'], 'url') ?>">Editar</a>
                                  <button type="button" usuarios-id="<?= esc($usuario_item['id'], 'url') ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarBorrado">Borrar</button>  
                              </div>
                          </div>
                      </li>
                  <?php endforeach ?>
              </ul>
      </div>
      <!-- FIN DEL BUCLE E INICIO DEL POSIBLE "NO HAY USUARIOS" -->
        <?php else : ?>
            <h3>Sin usuarios</h3>
            <p>No hemos encontrado usuarios.</p>
        <?php endif ?>
  </div>
  <!-- FIN DE LA TOMA DE DECISIONES-->


  <!-- Modal -->
  <div class="modal fade" id="confirmarBorrado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog">

          <div class="modal-content">

              <div class="modal-header">

                  <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar un usuario</h1>

                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>

              <div class="modal-body">

                  ¿Seguro que quiere borrar este usuario?

              </div>

              <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>

                  <button type="button" class="btn btn-primary" onclick="javascript:borradoConfirmado();">Si, estoy seguro</button>

              </div>

          </div>

      </div>

  </div>

    <script>

var idUsuariosPulsado;

/**

 * Captura del evento de click de cualquier botón de borrado

 * Al pulsar cualquier botón, sacamos el ID que llevaba dentro

 */

document.getElementById('confirmarBorrado').addEventListener('show.bs.modal', function(e) {

    idUsuariosPulsado = e.relatedTarget.getAttribute("usuarios-id");

});



/**

 * Se ha pulsado el botón confirmar del modal y conocemos el id a borrar

 * porque está en la variable idUsuariosPulsado

 */

function borradoConfirmado(){

    window.location.href = '/usuarios/borrarusuarios/' + idUsuariosPulsado;

}


</script>

