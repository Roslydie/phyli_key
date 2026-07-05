<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getStats()
    {
        $totalContacts = Contact::count();
        $newContacts = Contact::where('status', 'new')->count();
        $readContacts = Contact::where('status', 'read')->count();
        $closedContacts = Contact::where('status', 'closed')->count();

        $totalUsers = Users::count();
        $totalTestimonials = Testimonial::count();
        $publishedTestimonials = Testimonial::where('published', true)->count();

        // Messages reçus ce mois
        $contactsThisMonth = Contact::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        // Utilisateurs créés ce mois
        $usersThisMonth = Users::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        // Témoignages ce mois
        $testimonialsThisMonth = Testimonial::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

        // Messages par jour (7 derniers jours)
        $contactsByDay = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $count = Contact::whereDate('created_at', $date)->count();
            $contactsByDay[] = [
                'date' => date('d M', strtotime($date)),
                'count' => $count,
            ];
        }

        // Statuts des messages
        $contactsByStatus = [
            ['status' => 'Nouveau', 'count' => $newContacts, 'color' => 'warning'],
            ['status' => 'Lu', 'count' => $readContacts, 'color' => 'success'],
            ['status' => 'Fermé', 'count' => $closedContacts, 'color' => 'secondary'],
        ];

        // Messages reçus (5 derniers)
        $recentContacts = Contact::latest()->take(5)->get([
            'id', 'full_name', 'email', 'subject', 'status', 'created_at'
        ]);

        return response()->json([
            'contacts' => [
                'total' => $totalContacts,
                'new' => $newContacts,
                'read' => $readContacts,
                'closed' => $closedContacts,
                'this_month' => $contactsThisMonth,
            ],
            'users' => [
                'total' => $totalUsers,
                'this_month' => $usersThisMonth,
            ],
            'testimonials' => [
                'total' => $totalTestimonials,
                'published' => $publishedTestimonials,
                'unpublished' => $totalTestimonials - $publishedTestimonials,
                'this_month' => $testimonialsThisMonth,
            ],
            'charts' => [
                'contacts_by_day' => $contactsByDay,
                'contacts_by_status' => $contactsByStatus,
            ],
            'recent_contacts' => $recentContacts,
        ]);
    }
}
