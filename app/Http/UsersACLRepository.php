<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Auth;

class UsersACLRepository implements ACLRepository
{
    /**
     * Get user ID
     *
     * @return mixed
     */
    public function getUserID()
    {
        $auth = Auth::user();
        $id = $auth->id;
        $name = $auth->name;
        $role = $auth->roles->first()->name; //kabag-keperawatan
        return $id;
    }

    /**
     * Get ACL rules list for user
     *
     * @return array
     */
    public function getRules(): array
    {
        $auth = Auth::user();
        $id = $auth->id;
        $name = $auth->name;
        $role = $auth->roles->first()->name; //kabag-keperawatan

        $e = [];
        // Admin SIMRSKU.COM
        if (Auth::user()->hasRole('it')) {
            array_push($e,
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => '*', 'access' => 2], 
                ['disk' => 'managerfile', 'path' => '*/*', 'access' => 2], 
            );
        }

        // FOLDER @PKUSUKOHARJO
        array_push($e,
            ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
            ['disk' => 'managerfile', 'path' => '@PKUSUKOHARJO', 'access' => 1], 
            ['disk' => 'managerfile', 'path' => '@PKUSUKOHARJO/*', 'access' => 1], 
        );

        // DIREKTUR UTAMA
        if (Auth::user()->hasRole('direktur-utama')) {
            array_push($e,
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => '*', 'access' => 1],
                ['disk' => 'managerfile', 'path' => '*/*', 'access' => 1],
            );
        }

        // Direktur Keuangan & Perencanaan
        if (Auth::user()->hasRole('direktur-keuangan-perencanaan')) {
            array_push($e,
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/*', 'access' => 1],
            );
        }
            // Kabag Perencanaan dan Pengembangan RS
            if (Auth::user()->hasRole('kabag-perencanaan')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/*', 'access' => 1],
                );
            }
                // Kasubag Perencanaan dan IT
                if (Auth::user()->hasRole('kasubag-perencanaan-it')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Perencanaan dan IT', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Perencanaan dan IT/*', 'access' => 2], 
                    );
                }

                // Kasubag Diklat dan Pengembangan RS
                if (Auth::user()->hasRole('kasubag-diklat')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Diklat dan Pengembangan RS', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Diklat dan Pengembangan RS/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Marketing
                if (Auth::user()->hasRole('kasubag-marketing')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Marketing', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Kabag Perencanaan dan Pengembangan RS/Kasubag Marketing/*', 'access' => 2], 
                    );
                }
                
        
            // Kabag Keuangan
            if (Auth::user()->hasRole('kabag-keuangan')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan/*', 'access' => 1],   
                );
            }
                // Kasubag Perbendaharaan
                if (Auth::user()->hasRole('kasubag-perbendaharaan')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan/Kasubag Perbendaharaan', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan/Kasubag Perbendaharaan/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Akuntansi, Pajak, dan Verifikasi
                if (Auth::user()->hasRole('kasubag-verifikasi-akuntansi-pajak')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan/Kasubag Akuntansi, Pajak, dan Verifikasi', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Keuangan dan Perencanaan/Keuangan dan Perencanaan/Kasubag Akuntansi, Pajak, dan Verifikasi/*', 'access' => 2], 
                    );
                }
                

        // Direktur Umum & Kepegawaian
        if (Auth::user()->hasRole('direktur-umum-kepegawaian')) {
            array_push($e,
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/*', 'access' => 1],
            );
        }
            // Kabag Rumah tangga
            if (Auth::user()->hasRole('kabag-rumah-tangga')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/*', 'access' => 1], 
                );
            }
                // Kasubag Aset dan Gudang
                if (Auth::user()->hasRole('kasubag-aset-gudang')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag Aset dan Gudang', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag Aset dan Gudang/*', 'access' => 2], 
                    );
                }

                // Kasubag IPSRS
                if (Auth::user()->hasRole('kasubag-ipsrs')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag IPSRS dan Elektromedik', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag IPSRS dan Elektromedik/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Kesling dan K3 RS
                if (Auth::user()->hasRole('kasubag-kesling-k3')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag Kesling dan K3 RS', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Rumah Tangga/Kasubag Kesling dan K3 RS/*', 'access' => 2], 
                    );
                }
                

            // Kabag Kepegawaian
            if (Auth::user()->hasRole('kabag-kepegawaian')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian/*', 'access' => 1],
                );
            }
                // Kasubag Kepegawaian
                if (Auth::user()->hasRole('kasubag-kepegawaian')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian/Kasubag Kepegawaian', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian/Kasubag Kepegawaian/*', 'access' => 2], 
                    );
                }
                
                // Kasubag AIK
                if (Auth::user()->hasRole('kasubag-aik')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian/Kasubag AIK', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Kepegawaian/Kasubag AIK/*', 'access' => 2], 
                    );
                }
                

            // Kabag Umum
            if (Auth::user()->hasRole('kabag-umum')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/*', 'access' => 1],
                );
            }
                // Kasubag Tata Usaha
                if (Auth::user()->hasRole('kasubag-tata-usaha')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Tata Usaha', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Tata Usaha/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Humas, Hukum, dan Informasi
                if (Auth::user()->hasRole('kasubag-humas')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Humas, Hukum, dan Informasi', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Humas, Hukum, dan Informasi/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Penunjang Operasional
                if (Auth::user()->hasRole('kasubag-penunjang-operasional')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Penunjang Operasional', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Umum dan Kepegawaian/Kabag Umum/Kasubag Penunjang Operasional/*', 'access' => 2], 
                    );
                }
                

        // Di Bawah Pelayanan Medik, Keperawatan, dan Penunjang
        if (Auth::user()->hasRole('direktur-pelayanan-keperawatan-penunjang')) {
            array_push($e,
                ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/*', 'access' => 1],
            );
        }
            // Kabag Penunjang
            if (Auth::user()->hasRole('kabag-penunjang')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang/*', 'access' => 1],
                );
            }
                // Kasubag Penunjang Medik
                if (Auth::user()->hasRole('kasubag-penunjang-medik')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang/Kasubag Penunjang Medik', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang/Kasubag Penunjang Medik/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Penunjang Non Medik
                if (Auth::user()->hasRole('kasubag-penunjang-nonmedik')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang/Kasubag Penunjang Non Medik', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Penunjang/Kasubag Penunjang Non Medik/*', 'access' => 2], 
                    );
                }
                
            
            // Kabag Keperawatan
            if (Auth::user()->hasRole('kabag-keperawatan')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan/*', 'access' => 1],
                );
            }
                // Kasubag Keperawatan Rajal dan Gadar
                if (Auth::user()->hasRole('kasubag-keperawatan-rajal-gadar')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan/Kasubag Keperawatan Rajal dan Gadar', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan/Kasubag Keperawatan Rajal dan Gadar/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Keperawatan Ranap
                if (Auth::user()->hasRole('kasubag-keperawatan-ranap')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan/Kasubag Keperawatan Ranap', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Keperawatan/Kasubag Keperawatan Ranap/*', 'access' => 2], 
                    );
                }
                

            // Kabag Pelayanan Medik
            if (Auth::user()->hasRole('kabag-pelayanan-medik')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik/*', 'access' => 1],
                );
            }
                // Kasubag Rajal dan Gadar
                if (Auth::user()->hasRole('kasubag-rajal-gadar')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik/Kasubag Rajal dan Gadar', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik/Kasubag Rajal dan Gadar/*', 'access' => 2], 
                    );
                }
                
                // Kasubag Ranap
                if (Auth::user()->hasRole('kasubag-ranap')) {
                    array_push($e,
                        ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang', 'access' => 1],
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik/Kasubag Ranap', 'access' => 1],   
                        ['disk' => 'managerfile', 'path' => 'Pelayanan Medik, Keperawatan, dan Penunjang/Kabag Pelayanan Medik/Kasubag Ranap/*', 'access' => 2], 
                    );
                }
                

        // TIM - Langsung ke Direktur Utama
            // SPV
            if (Auth::user()->hasRole('spv')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/SPV', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/SPV/*', 'access' => 2], 
                );
            }

            // MPP
            if (Auth::user()->hasRole('mpp')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/MPP', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/MPP/*', 'access' => 2], 
                );
            }

            // PMKP
            if (Auth::user()->hasRole('pmkp')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/PMKP', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/PMKP/*', 'access' => 2], 
                );
            }

            // PKRS
            if (Auth::user()->hasRole('pkrs')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/PKRS', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/PKRS/*', 'access' => 2], 
                );
            }

            // PPI
            if (Auth::user()->hasRole('ppi')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/PPI', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/PPI/*', 'access' => 2], 
                );
            }

            // SPI
            if (Auth::user()->hasRole('spi')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/SPI', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/SPI/*', 'access' => 2], 
                );
            }

            // ASURANSI
            if (Auth::user()->hasRole('asuransi')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Tim/ASURANSI', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Tim/ASURANSI/*', 'access' => 2], 
                );
            }


        // KOMITE - Langsung ke Direktur Utama
            // Komite Keperawatan
            if (Auth::user()->hasRole('komite-keperawatan')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Komite', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Komite/Komite Keperawatan', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Komite/Komite Keperawatan/*', 'access' => 2], 
                );
            }

            // Komite Medik
            if (Auth::user()->hasRole('komite-medik')) {
                array_push($e,
                    ['disk' => 'managerfile', 'path' => '/', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Komite', 'access' => 1],
                    ['disk' => 'managerfile', 'path' => 'Komite/Komite Medik', 'access' => 1],   
                    ['disk' => 'managerfile', 'path' => 'Komite/Komite Medik/*', 'access' => 2], 
                );
            }

        // TUTOR
        // ['disk' => 'images', 'path' => 'nature', 'access' => 0],      // guest don't have access for this folder
        // ['disk' => 'images', 'path' => 'icons', 'access' => 1],       // only read - guest can't change folder - rename, delete
        // ['disk' => 'images', 'path' => 'icons/*', 'access' => 1],     // only read all files and foders in this folder
        // ['disk' => 'images', 'path' => 'image*.jpg', 'access' => 0],  // can't read and write (preview, rename, delete..)
        // ['disk' => 'images', 'path' => 'avatar.png', 'access' => 1],  // only read (view)
        // ROLE : 2 is master.
        return $e;
    }
}