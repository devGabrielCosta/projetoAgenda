<template>
  <div class="insertScheduleCard">  
    <h1>Inserir atendimento</h1>
    <form @submit.prevent="submitForm">
      <label for="user_id">ID do Usuário:</label>
      <textarea type="text" id="user_id" v-model="userId"></textarea>
      <button type="submit">Enviar</button>
    </form>
  </div>
</template>

<script>

  export default {
  }
  
</script>

<style scoped>

  .insertScheduleCard{
    background-color: white;

      form {
      margin-top: 20px;
      }
      label {
        display: block;
        margin-bottom: 5px;
      }
      textarea {
        width: 100%;
        min-height: 150px;
        padding: 5px;
        margin-bottom: 10px;
        resize: none;
      }
      button:hover {
        background-color: #0056b3;
      }
  }

</style>
