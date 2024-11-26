<!-- src/components/QuestionList.vue -->
<template>
    <div>
        <h1>Questions</h1>
        <div v-for="question in questions" :key="question.id">
            <h2>{{ question.title }}</h2>
            <img v-if="question.image_url" :src="question.image_url" alt="Question image" />
            <ul>
                <li v-for="answer in question.answers" :key="answer.id">
                    {{ answer.content }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            questions: [],
        };
    },
    async mounted() {
        const response = await axios.get('http://localhost/api/questions');
        this.questions = response.data;
    },
};
</script>
