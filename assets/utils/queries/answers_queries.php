<?php

function createAnswersTableIfNeeded($db){
    $query = 'CREATE TABLE IF NOT EXISTS `answers` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `question_id` int(11) DEFAULT NULL,
                  `value` text,
                  `answered_by` int(11) DEFAULT NULL,
                  `is_selected_as_answer` tinyint(1) DEFAULT \'0\',
                  PRIMARY KEY (`id`),
                  KEY `answers_fk` (`question_id`),
                  KEY `answers_fk_1` (`answered_by`),
                  CONSTRAINT `answers_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
                  CONSTRAINT `answers_fk_1` FOREIGN KEY (`answered_by`) REFERENCES `users` (`id`)
                )';
    $result = $db->query($query);
}

function addAnswers($db, $questionId, $text, $answeredBy){
    $query = 'INSERT INTO answers (question_id, `value`, answered_by) VALUES (?, ?, ?);';
    $stmt = $db->prepare($query);
    $stmt->bind_param('isi', $questionId, $text, $answeredBy);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function getAnswerByQuestionId($db, $questionId){
    $id = null;
    $qId = null;
    $answer = null;
    $answeredBy = null;
    $isSelected = null;
    $result = array();
    $index = 0;

    $query = 'SELECT * FROM answers WHERE question_id = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $questionId);
    $stmt->execute();
    $stmt->bind_result($id, $qId, $answer, $answeredBy, $isSelected);
    while($stmt->fetch()){
        $result[$index]['id'] = $id;
        $result[$index]['questionId'] = $qId;
        $result[$index]['answer'] = $answer;
        $result[$index]['answeredBy'] = $answeredBy;
        $result[$index]['isSelected'] = $isSelected;
        $index += 1;
    }
    $stmt->free_result();
    return $result;
}

function selectAsAnswerByAnswerId($db, $bool, $answerId){
    $query = 'UPDATE answers SET is_selected_as_answer = ? WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $bool, $answerId);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
