<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Certificate\Domain\Entities\Certificate;
use Illuminate\Support\Carbon;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        Certificate::truncate();

        $data = [
            [
                'name' => 'AWS Certified Solutions Architect – Associate',
                'issuer' => 'Amazon Web Services (AWS)',
                'issued_date' => Carbon::parse('2023-03-15'),
                'expiration_date' => Carbon::parse('2026-03-15'),
                'credential_id' => 'AWS-ARCH-12345',
                'credential_url' => 'https://aws.amazon.com/certification/certified-solutions-architect-associate/',
                'description' => 'Validated ability to design distributed systems on AWS platform.',
                'created_by' => 1,
            ],
            [
                'name' => 'Google Professional Cloud Architect',
                'issuer' => 'Google Cloud',
                'issued_date' => Carbon::parse('2022-08-10'),
                'expiration_date' => Carbon::parse('2025-08-10'),
                'credential_id' => 'GCP-ARCH-67890',
                'credential_url' => 'https://cloud.google.com/certification/cloud-architect',
                'description' => 'Certified to architect cloud solutions using GCP infrastructure.',
                'created_by' => 1,
            ],
            [
                'name' => 'Microsoft Certified: Azure Fundamentals',
                'issuer' => 'Microsoft',
                'issued_date' => Carbon::parse('2021-01-05'),
                'expiration_date' => null,
                'credential_id' => 'AZURE-FUND-11111',
                'credential_url' => 'https://learn.microsoft.com/en-us/certifications/azure-fundamentals/',
                'description' => 'Fundamental knowledge of Azure cloud services.',
                'created_by' => 1,
            ],
        ];

        foreach ($data as $item) {
            Certificate::create($item);
        }
    }
}
