<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model {
    protected $table = 'questions';
    protected $allowedFields = ['id', 'question_text', 'problem_type', 'next_if_yes', 'next_if_no', 'is_initial'];

    public function getTotalQuestions()
    {
        return $this->countAll();
    }

    public function getQuestionById($id)
    {
        return $this->find($id);
    }

    public function getInitialQuestion($problemType) {
        return $this->where('problem_type', $problemType)
                    ->where('id LIKE', 'q1%')
                    ->first();
    }

    public function getNextQuestion($currentId, $answer) {
        $current = $this->find($currentId);
        return $answer === 'yes' ? $current['next_if_yes'] : $current['next_if_no'];
    }
}