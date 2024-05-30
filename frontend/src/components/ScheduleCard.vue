<template>
  <div class="calendar">
    <div class="selectors">
      <select id="role" v-model="selectedRole">
        <option value="">Selecione...</option>
        <option value="admin">Administrador</option>
      </select>         
      <select id="role" v-model="selectedRole">
        <option value="">Selecione...</option>
        <option value="admin">Administrador</option>
      </select>
    </div>
    <div class="schedules">
      <div class="line">
        <div>01/01/01 01:01:01</div>
        <div>Paciente 123</div>
        <div>Status</div>
      </div>
      <div class="line">
        <div>01/01/01 01:01:01</div>
        <div>Paciente 123</div>
        <div>Status</div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
  }
  
</script>

<style scoped>

  .calendar{
    background-color: white;
    min-width: 500px;
    height: 35vh;
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 2vw;

    .selectors{
      width: 50%;
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    .schedules{
      width: 90%;
      display: flex;
      gap: 1vh;
      flex-direction: column;
      justify-content: start;
      align-items: center;

      > .line{
        display: flex;
        justify-content: space-around;
        width: 99%;
        padding: 1%;
        border: 2px solid black;
      }
    }
  }

</style>
