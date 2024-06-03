<template>
  <header>
    <div>{{ loggedUser?.type }} - {{ loggedUser?.name }}</div>
    <button @click="logout">Logout</button>
  </header>
  <main class="home-main">
    <div class="content-delimiter">
        <ScheduleCard :class="'box-shadow fix-size fix-padding'" />
        <InsertScheduleCard v-if="isReceptionist" :class="'box-shadow fix-size fix-padding'"/>
        <AssessmentCard v-else-if="!isReceptionist && selectedSchedule" :class="'box-shadow fix-size fix-padding'"/>
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

<style>

  header{
    background-color: black;
    color: white;
    padding: 0 4vw;
    height: 4vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .home-main{
    background-color: rgb(216, 206, 206);
    height: 96vh;
  }

  .content-delimiter{
    width: min(95vw, 1000px);
    height: 100%;
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    gap: 3vh;
  }

  .fix-padding{
    padding: 2vh;
  }

  .fix-size{
    width: 100%;
    height: 40vh;
  }

</style>