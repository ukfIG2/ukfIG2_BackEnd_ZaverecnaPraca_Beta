import axios from "axios"

const API_ENDPOINT_CONFERENCES = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/conferences';
const API_ENDPOINT_STAGES = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/stages';
const API_ENDPOINT_TIME_TABLES = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/time_tables';
const API_ENDPOINT_PRESENTATIONS = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/presentations';
const API_ENDPOINT_ADMINISTRATIONS = 'http://localhost/ukfIG2_ZaverecnaPraca_Beta/Aplikácia/BackEnd/public/api/administrations';


export default {
    API_ENDPOINT_CONFERENCES,
    API_ENDPOINT_STAGES,
    API_ENDPOINT_TIME_TABLES,
    API_ENDPOINT_PRESENTATIONS,
    API_ENDPOINT_ADMINISTRATIONS,


    async fetchConferenceData() {
        const response = await axios.get(API_ENDPOINT_CONFERENCES);
        return response.data;
    },

    async fetchStageData() {
        const response = await axios.get(API_ENDPOINT_STAGES);
        return response.data;
    },

    async fetchTimeTableData() {
        const response = await axios.get(API_ENDPOINT_TIME_TABLES);
        return response.data;
    },

    async fetchPresentationData() {
        const response = await axios.get(API_ENDPOINT_PRESENTATIONS);
        return response.data;
    }

    
    
}