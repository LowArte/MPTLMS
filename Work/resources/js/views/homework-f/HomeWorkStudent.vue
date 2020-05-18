<template lang="pug">
    
</template>

<script>

export default {
    post_name: {
    name: "Домашнее задание",
    url: "homework_student",
    dop_com: [
      //!Прописать путь до вывода подробностей об задании
      {
        url: "journal/:group_id",
        path: "js/views/journal-f/JournalOfSubjects"
      }
    ]
  },
    
}
</script>