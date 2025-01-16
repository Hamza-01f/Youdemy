<?php

namespace App\Controllers;

// require_once __DIR__.'/../models/Enrollment.php';

use App\Models\Enrollment;

class EnrollmentController {

    public function enrollStudent($studentId, $courseId) {
            $enrollmentModel = new Enrollment();
        $enrollmentModel->createEnrollment($studentId, $courseId);
    }

    public function checkEnrollment($studentId, $courseId) {
        $enrollmentModel = new Enrollment();
        return $enrollmentModel->isEnrolled($studentId, $courseId);
    }
}
