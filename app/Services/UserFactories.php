<?php

require_once __DIR__ . '/../Entities/User.php';
require_once __DIR__ . '/../Entities/BasicUser.php';
require_once __DIR__ . '/../Entities/ProUser.php';
require_once __DIR__ . '/../Entities/Moderator.php';
require_once __DIR__ . '/../Entities/Administrator.php';

class UserFactory
{
    public static function checkRole(array $row): User
    {
        switch ($row['role']) {

            case 'basic':
                $user = new BasicUser(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['profile_photo'],
                    $row['bio']
                );
                break;

            case 'pro':
                $user = new ProUser(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['profile_photo'],
                    $row['bio'],
                    $row['subscription_start'],
                    $row['subscription_end']
                );
                break;

            case 'moderator':
                $user = new Moderator(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['profile_photo'],
                    $row['bio'],
                    $row['moderator_level']
                );
                break;

            case 'admin':
                $user = new Administrator(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['profile_photo'],
                    $row['bio'],
                    (bool)$row['is_super_admin']
                );
                break;

            default:
                throw new InvalidArgumentException("Rôle utilisateur inconnu");
        }

        $user->setId($row['id']);
        return $user;
    }
}
