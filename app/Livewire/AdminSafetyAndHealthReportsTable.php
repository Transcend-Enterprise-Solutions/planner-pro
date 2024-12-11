<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\CpMonthlyReports;
use Illuminate\Support\Facades\DB;

class AdminSafetyAndHealthReportsTable extends Component
{
    public $reports = [];
    public $search = '';
    public $selectedYear;
    public $availableYears = [];

    public function mount()
    {
        $this->availableYears = $this->getAvailableYears();
        $this->selectedYear = $this->availableYears[0] ?? date('Y');
        $this->loadReportData();
    }

    public function updatedSearch()
    {
        $this->loadReportData();
    }

    public function updatedSelectedYear()
    {
        $this->loadReportData();
    }

    private function getAvailableYears()
    {
        $years = CpMonthlyReports::selectRaw('YEAR(month) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        if (empty($years)) {
            $currentYear = date('Y');
            $years = [$currentYear];
        }

        return $years;
    }

    public function loadReportData()
    {
        $reports = CpMonthlyReports::join('users', 'users.id', 'cp_monthly_reports.user_id')
            ->leftJoin(
                DB::raw('(SELECT report_id, 
                                GROUP_CONCAT(DISTINCT desease SEPARATOR ", ") as diseases, 
                                SUM(no_of_cases) as total_cases 
                        FROM monthly_deseases 
                        GROUP BY report_id) as monthly_deseases_aggregated'),
                'cp_monthly_reports.id',
                '=',
                'monthly_deseases_aggregated.report_id'
            )
            ->select(
                'cp_monthly_reports.user_id',
                'cp_monthly_reports.permit_number',
                DB::raw('YEAR(cp_monthly_reports.month) as year'),
                DB::raw('QUARTER(cp_monthly_reports.month) as quarter'),
                DB::raw('SUM(cp_monthly_reports.non_lost_time_accident) as total_nlta'),
                DB::raw('SUM(cp_monthly_reports.non_fatal_lost_time_accident) as total_lta_nf'),
                DB::raw('SUM(cp_monthly_reports.fatal_lost_time_accident) as total_lta_f'),
                DB::raw('SUM(COALESCE(cp_monthly_reports.nflt_days_lost, 0) + COALESCE(cp_monthly_reports.flt_days_lost, 0)) as total_days_lost'),
                DB::raw('SUM(cp_monthly_reports.man_hours) as total_manhours'),
                DB::raw('SUM(cp_monthly_reports.male_workers) as total_male'),
                DB::raw('SUM(cp_monthly_reports.female_workers) as total_female'),
                DB::raw('MAX(monthly_deseases_aggregated.diseases) as diseases'), // Use MAX as GROUP_CONCAT is pre-aggregated
                DB::raw('SUM(monthly_deseases_aggregated.total_cases) as total_cases')
            )
            ->when($this->selectedYear, function ($query) {
                return $query->whereYear('cp_monthly_reports.month', $this->selectedYear);
            })
            ->when($this->search, function ($query) {
                return $query->search(trim($this->search));
            })
            ->groupBy('cp_monthly_reports.user_id', 'cp_monthly_reports.permit_number', 'year', 'quarter')
            ->get();

    
        $result = [];
        foreach ($reports as $report) {
            $mineOperator = $report->user->company_name ?? 'N/A';
            $tenement = $report->permit_number ?? 'N/A';
            $quarterName = $this->getQuarterName($report->quarter);
    
            // Create a unique key for each company-permit combination
            $key = $mineOperator . ' - ' . $tenement;
    
            if (!isset($result[$key])) {
                $result[$key] = [
                    'Company' => $mineOperator,
                    'Tenement' => $tenement,
                    'First Quarter' => $this->getDefaultQuarterData(),
                    'Second Quarter' => $this->getDefaultQuarterData(),
                    'Third Quarter' => $this->getDefaultQuarterData(),
                    'Fourth Quarter' => $this->getDefaultQuarterData(),
                ];
            }
    
            $result[$key][$quarterName] = [
                'NLTA' => $report->total_nlta,
                'LTA-NF' => $report->total_lta_nf,
                'LTA-F' => $report->total_lta_f,
                'Days Lost' => $report->total_days_lost,
                'Manhours Worked' => $report->total_manhours,
                'Male Employees' => $report->total_male,
                'Female Employees' => $report->total_female,
                'Total Employees' => $report->total_male + $report->total_female,
                'Recorded Diseases' => $report->diseases ?: 'None',
                'No. of Cases' => $report->total_cases ?: 0,
            ];
        }
   
        $this->reports = $result;
    }

    
    private function getQuarterName($quarter)
    {
        return match ($quarter) {
            1 => 'First Quarter',
            2 => 'Second Quarter',
            3 => 'Third Quarter',
            4 => 'Fourth Quarter',
            default => 'Unknown Quarter',
        };
    }

    private function getDefaultQuarterData()
    {
        return [
            'NLTA' => 0,
            'LTA-NF' => 0,
            'LTA-F' => 0,
            'Days Lost' => 0,
            'Manhours Worked' => 0,
            'Male Employees' => 0,
            'Female Employees' => 0,
            'Total Employees' => 0,
            'Recorded Diseases' => 'None',
            'No. of Cases' => 0,
        ];
    }

    public function render()
    {
        return view('livewire.admin-safety-and-health-reports-table');
    }
}