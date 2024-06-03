<template>
  <header>
    <div>{{ loggedUser?.type }} - {{ loggedUser?.name }}</div>
    <button @click="logout">Logout</button>
  </header>
  <main class="home-main">
    <div class="content-delimiter">
        <ScheduleCard :class="'box-shadow schedule-card card'" />
        <InsertScheduleCard v-if="isReceptionist" :class="'box-shadow insert-schedule-card card'"/>
        <AssessmentCard v-else-if="!isReceptionist && selectedSchedule" :class="'box-shadow assessment-card card'"/>
    </div> 
  </main>
</template>

<script>
  import ScheduleCard from '../components/ScheduleCard.vue'
  import InsertScheduleCard from '../components/InsertScheduleCard.vue'
  import AssessmentCard from '../components/AssessmentCard.vue' 
  import { reactive, provide } from 'vue';

  export default {
    data(){
      const viewState = reactive({
        selectedSchedule: null,
        reloadScheduleCard: false
      })

      provide('viewState', viewState);

      return {
        viewState
      }
    },
    computed: {
      loggedUser(){
        return this.$store.state.loggedUser;
      },
      isReceptionist() { 
        return this.$store.getters.getLoggedType == 'Receptionist';
      },
      selectedSchedule() { 
        return this.viewState.selectedSchedule;
      },
    },
		components: {
      ScheduleCard,
      InsertScheduleCard,
      AssessmentCard
		},
    methods: {
      logout(){
        this.$store.dispatch('logout');
        this.$router.push('/login');
      }
    }
  }
</script>

<style scoped>

  header{
    background-color: black;
    color: white;
    padding: 0 2vh;
    height: 3vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .home-main{
    background-color: rgb(216, 206, 206);
    height: 97vh; 
    overflow: auto;
  }

  .card{
    padding: 2vh 2vw;
    border-radius: 10px;
  }

  .schedule-card{
    width: 100%;
    max-height: 50vh;
  }

  .insert-schedule-card{
    width: 100%;
  }

  .assessment-card{
    width: 100%;
    min-height: 30vh;
  }

</style>