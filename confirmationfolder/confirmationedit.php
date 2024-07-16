<style>
  .confirmationHolder {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, .4);
    top: 0;
    left: 0;
    display: none;
    z-index: 3;
  }

  .confirmation {
    position: absolute;
    width: 30%;
    max-width: 400px;
    background-color: wheat;
    border-radius: 20px;
    padding: 20px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  .confirmation h1 {
    color: red;
  }

  .confirmation p {
    color: black;
    text-decoration: underline;
  }

  .confirmation button {
    margin: 10px;
  }
</style>

<div class="confirmationHolder" id="confirmationedit">
  <div class="confirmation" id="confirmation1">
    <h1>Are you sure you want to continue?</h1>
    <button onclick="submitEditForm()">YES</button>
    <button onclick="closeEditConfirmation()">NO</button>
  </div>
</div>

<script>
  var confirmationHolderEdit = document.getElementById("confirmationedit");
  var editform = document.getElementById("editform");

  function validateEditForm() {
    confirmationHolderEdit.style.display = "block";
    return false;
  }

  function closeEditConfirmation() {
    confirmationHolderEdit.style.display = "none";
  }

  function submitEditForm() {
    editform.submit();
  }

  window.onclick = function(event) {
    if (event.target == confirmationHolderEdit) {
      closeEditConfirmation();
    }
  };
</script>
