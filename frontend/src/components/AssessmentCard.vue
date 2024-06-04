<template>
  <div class="assessment-card">  
    <h2>
      Atendimento {{ selectedSchedule?.id }} <template v-if="isDoctor">- {{ selectedSchedule.patient.name }}</template>
      <button class="red" @click="patientNoShow" v-if="showInsertFunctions">Não compareceu</button>
    </h2>
    <form @submit.prevent="sendForm">
      <label for="comment">Texto da avaliação</label>
      <textarea class="comment" v-model="comment" v-if="showInsertFunctions" required></textarea>
      <textarea class="comment" v-model="textAreaValue" :disabled="true" v-else></textarea>
      <button class="green" type="submit" v-if="showInsertFunctions">Enviar</button>
    </form>
  </div>
</template>

<script>

  import { inject } from 'vue';

  export default {
    props: ['scheduleId'],
    data() {
      const viewState = inject('viewState');

      return {
        comment: null,
        viewState,      
      };
    }, 
    computed: {
      loggedType() { 
        return this.$store.getters.getLoggedType;
      },
      isDoctor() { 
        return this.loggedType == 'Doctor';
      },
      showInsertFunctions() { 
        return this.isDoctor && this.selectedSchedule?.status == 'Created';
      },
      isReceptionist() { 
        return this.loggedType == 'Receptionist';
      },
      selectedSchedule() { 
        return this.viewState.selectedSchedule;
      },
      textAreaValue(){
        return this.selectedSchedule?.assessment?.comment
      }
    }, 
    methods: {
      sendForm()
      { 
        this.axios
          .post('assessment', {
            schedule_id: this.selectedSchedule.id,
            comment: this.comment
          })
          .then(response => {
            if(response.data)
              this.changeStateSchedule(null);
          })
      },
      patientNoShow(){
        this.axios
          .patch('schedule/'+this.selectedSchedule.id, {
            status: 'NoShow'
          })
          .then(response => {
            if(response.data)
              this.changeStateSchedule(null);
          })
      },
      changeStateSchedule(schedule){
        this.viewState.selectedSchedule = schedule
        this.viewState.reloadScheduleCard = true;
      }
    }
  }
  
</script>

<style scoped>

  .assessment-card{
    background-color: white;

      h2{
        height: 3vh;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      form {
        margin-top: 1rem;
      }
      label {
        display: block;
        margin-bottom: 0.5rem;
      }
      textarea {
        width: 100%;
        min-height: 8rem;
        margin-bottom: 1rem;
        resize: none;
        padding: 0.2rem;
      }
  }

</style>
