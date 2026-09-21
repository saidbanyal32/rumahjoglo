<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlataranThemeController extends Controller
{
    /**
     * Data Ruang & Area Terkurasi (Spaces & Sanctuaries)
     */
    private function getSpaces()
    {
        return [
            [
                'id' => 'grand-pendopo',
                'name' => 'The Grand Pendopo',
                'subtitle' => 'Open-Air Teak Pavilion of Noble Proportions',
                'capacity' => 'Up to 400 Guests',
                'dimension' => '320 sqm covered area',
                'image' => asset('assets/joglo.jpg'),
                'description' => 'A masterwork of ancient Javanese carpentry, crowned by authentic soaring Tumpang Sari ceilings and four centenary teak Saka Guru pillars. Designed to embrace gentle mountain breezes and frame unforgettable gatherings in timeless grace.'
            ],
            [
                'id' => 'ndalem-suite',
                'name' => 'The Royal Ndalem Suite',
                'subtitle' => 'Private Heritage Living & Bridal Sanctuary',
                'capacity' => 'Private Residence / 4 Suites',
                'dimension' => '180 sqm private wing',
                'image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1600&q=85',
                'description' => 'Discreetly secluded within the courtyard, offering opulent private bridal suites, hand-carved mahogany bedposts, temperature-controlled dressing quarters, and tranquil en-suite marble sanctuaries.'
            ],
            [
                'id' => 'emerald-lawn',
                'name' => 'The Emerald Lawn & Water Courtyard',
                'subtitle' => 'Al Fresco Tropical Gardens & Sunset Canopy',
                'capacity' => 'Cocktails & Garden Banquets',
                'dimension' => '650 sqm landscaped lawns',
                'image' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1600&q=85',
                'description' => 'Manicured Japanese emerald turf surrounded by native frangipani blossoms, ancient fern foliage, and soothing reflection pools, setting an ethereal stage for vows beneath starlit skies.'
            ]
        ];
    }

    /**
     * Data Pengalaman & Paket Eksklusif (Bespoke Offerings)
     */
    private function getExperiences()
    {
        return [
            [
                'id' => 'royal-wedding',
                'title' => 'The Royal Wedding Soirée',
                'tagline' => 'A Bespoke Celebration of Sacred Matrimony',
                'duration' => 'Full-Day Seclusion (12 Hours Exclusive Access)',
                'guest_recommendation' => 'Ideal for 200 – 400 Distinguished Guests',
                'price' => 'IDR 24.500.000',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1200&q=85',
                'inclusions' => [
                    'Exclusive buy-out of the entire sanctuary (Grand Pendopo, Lawns & Residence)',
                    '2 Luxurious Air-Conditioned Bridal & VIP Dressing Chambers with en-suite amenities',
                    'High-capacity 10.000 VA power infrastructure + Silent Genset backup',
                    'Authentic antique teak buffet tables & traditional artisanal food stations',
                    'Dedicated Estate Concierge & Event Captain on-site throughout your momentous day',
                    'Complimentary romantic overnight stay for the bridal couple at The Ndalem Suite',
                    'Private valet coordination & secured gated estate parking for 45+ vehicles',
                    'Flexible H-1 evening preparation access for bespoke decor installation'
                ],
                'note' => 'Custom culinary pairing & external catering welcome with zero corkage restrictions.'
            ],
            [
                'id' => 'intimate-heritage',
                'title' => 'Intimate Heritage Ceremony',
                'tagline' => 'Sacred Vows, Siraman & Reverent Celebrations',
                'duration' => 'Half-Day Access (6 Hours of Refined Seclusion)',
                'guest_recommendation' => 'Tailored for 50 – 150 Cherished Guests',
                'price' => 'IDR 10.500.000',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=1200&q=85',
                'inclusions' => [
                    'Private staging at The Grand Pendopo & connecting verandah',
                    '1 VIP preparation suite with climate control & vanity mirrors',
                    'Bespoke acoustic sound arrangement with wireless microphones',
                    '60 Classic covered banqueting chairs in warm cream linen',
                    'Artisanal welcome refreshments (Warm Wedang herbal infusion upon arrival)',
                    'Dedicated discreet estate service staff during the ceremony',
                    'Reserved priority parking spaces for VIP family vehicles'
                ],
                'note' => 'Ideal for morning sacred ceremonies bathed in soft natural dawn light.'
            ],
            [
                'id' => 'sanctuary-retreat',
                'title' => 'Sanctuary Living & Private Estate Buyout',
                'tagline' => 'Unrushed Heritage Respite for Discerning Families',
                'duration' => '24-Hour Estate Buyout (Check-in 14:00, Check-out 12:00)',
                'guest_recommendation' => 'Accommodates up to 18 Overnight Guests',
                'price' => 'IDR 5.800.000',
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=85',
                'inclusions' => [
                    'Complete private access to all 3 Heritage Villa suites & living pavilions',
                    'Artisanal farm-to-table breakfast for 15 guests curated with local Javanese delicacies',
                    'Evening lawn bonfire setup with traditional sweet potato & warm bajigur',
                    'Fully appointed gourmet kitchen with private refrigerator & cooking equipment',
                    'High-speed fiber connectivity (100 Mbps) across all indoor & outdoor sanctuaries',
                    'Private garden BBQ grill station under the star-canopied lawn'
                ],
                'note' => 'A restorative haven designed for generational reunions and serene quietude.'
            ],
            [
                'id' => 'editorial-production',
                'title' => 'Artisanal Visual & Editorial Production',
                'tagline' => 'Cinematic Light & Authentic Cultural Textures',
                'duration' => '6 Hours Private Creative Access',
                'guest_recommendation' => 'Production Crew of up to 15 Curators & Artists',
                'price' => 'IDR 3.200.000',
                'image' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=1200&q=85',
                'inclusions' => [
                    'Full artistic freedom across all architectural facades, carved tumpang sari & lush gardens',
                    'Private climate-controlled changing chamber with full-length vanity mirror',
                    'Continuous electrical support for studio strobe & cinematic lighting rigs',
                    'Access to authentic Javanese antique props & heritage wooden ornaments',
                    'Free flow of mineral water and herbal refreshments for the creative team'
                ],
                'note' => 'Exquisite natural morning side-lighting across the teak timber structure.'
            ]
        ];
    }

    /**
     * Privilese Layanan Luxury Hospitality
     */
    private function getPrivileges()
    {
        return [
            [
                'title' => 'Total Seclusion',
                'subtitle' => 'One Event at a Time',
                'desc' => 'We honor your privacy above all. The sanctuary hosts only a single prestigious gathering at any given moment, guaranteeing uncompromised intimacy.',
                'icon' => 'fa-shield-halved'
            ],
            [
                'title' => 'Centenary Teak Artistry',
                'subtitle' => 'Hand-Carved Heritage',
                'desc' => 'Constructed from reclaimed teakwood aged over a century, offering authentic acoustic resonance and timeless historical gravitas.',
                'icon' => 'fa-feather-pointed'
            ],
            [
                'title' => 'Dedicated Concierge',
                'subtitle' => 'Attentive Venue Butler',
                'desc' => 'From initial route coordination to subtle cue assistance during ceremonies, our discreet estate team tends to your every wish.',
                'icon' => 'fa-bell-concierge'
            ],
            [
                'title' => 'Culinary Freedom',
                'subtitle' => 'No Corkage Penalties',
                'desc' => 'Collaborate with your preferred fine dining caterers and bespoke mixologists with effortless kitchen staging and no punitive fees.',
                'icon' => 'fa-champagne-glasses'
            ]
        ];
    }

    /**
     * Halaman Utama Luxury Theme (/luxury)
     */
    public function home()
    {
        $spaces = $this->getSpaces();
        $experiences = $this->getExperiences();
        $privileges = $this->getPrivileges();

        return view('themes.plataran.pages.home', compact('spaces', 'experiences', 'privileges'));
    }

    /**
     * Halaman Detail Paket / Penawaran (/luxury/experiences)
     */
    public function experience()
    {
        $experiences = $this->getExperiences();
        $spaces = $this->getSpaces();

        return view('themes.plataran.pages.experience', compact('experiences', 'spaces'));
    }

    /**
     * Halaman Formulir Reservasi Elegan (/luxury/reserve)
     */
    public function reserve(Request $request)
    {
        $experiences = $this->getExperiences();
        $selectedExperience = $request->query('experience', '');

        return view('themes.plataran.pages.reserve', compact('experiences', 'selectedExperience'));
    }
}

