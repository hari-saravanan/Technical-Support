<?php

function createQuestionTableIfNeeded($db){
        $query = "CREATE TABLE IF NOT EXISTS `questions` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `title` varchar(100) DEFAULT NULL,
                      `description` text,
                      `is_solved` tinyint(1) DEFAULT '0',
                      `created_by` int(11) DEFAULT NULL,
                      PRIMARY KEY (`id`),
                      KEY `questions_fk` (`created_by`),
                      CONSTRAINT `questions_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
                    )";
        $result = $db->query($query);
}

function insertQuestions($db, $title, $description, $createdBy){
    $query = "INSERT INTO questions (title, description, created_by) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssi', $title, $description, $createdBy);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

function getQuestionsById($db, $questionId){
    $result = array();
    $query = 'SELECT * FROM questions WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $questionId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($result['id'], $result['title'], $result['description'], $result['isSolved'], $result['createdBy']);
    $stmt->fetch();
    $stmt->free_result();
    return $result;
}

function getQuestions($db){
    $query = "SELECT * FROM questions";
    $stmt = $db->query($query);

    return $stmt;
}

function getQuestionCount($db){
    $query = "SELECT COUNT(*) FROM questions";
    $stmt = $db->query($query);

    return mysqli_num_rows($stmt);
}

function solvedQuestion($db, $questionId){
    $query = 'UPDATE questions SET is_solved = 1 WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $questionId);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}

