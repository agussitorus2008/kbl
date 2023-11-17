<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'orders_this_month' => $this->ordersThisMonth,
            'order_percentage' => $this->orderPercentage,
            'average_daily_orders' => $this->averageDailyOrders,
            'average_daily_orders_percentage' => $this->averageDailyOrdersPercentage,
            'customer_this_month' => $this->customerThisMonth,
            'customer_today' => $this->customerToday,
            'orders_seven_days' => $this->ordersSevenDays,
            'order_categories' => $this->categories,
            'max_order_amount' => $this->max,
            'min_order_amount' => $this->min,
            'total_order_amount' => $this->totalAmount,
            'executive_order_data' => $this->executiveData,
            'executive_order_labels' => $this->executiveLabels,
            'non_executive_order_data' => $this->nonExecutiveData,
            'non_executive_order_labels' => $this->nonExecutiveLabels,
            'executive_percentage' => $this->executivePercentage,
            'non_executive_percentage' => $this->nonExecutivePercentage,
            'percentages' => $this->percentages,
            'total_orders' => $this->totalOrders,
        ];
    }
}
