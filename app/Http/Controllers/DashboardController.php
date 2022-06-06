<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\Contracts\ValutesInfoServiceInterface;
use App\Services\ValutesInfoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kutia\Larafirebase\Services\Larafirebase;
use PhpParser\Node\Stmt\DeclareDeclare;

class DashboardController extends Controller
{

    public function regenerateToken(Request $request) {
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function getValutes(Request $request) {
        try {
            /*
             * Если данные realtime , то необходимо их брать из очереди и хендлить , в данном случае беру из запроса
             */
            $validator = Validator::make($request->all(), [
                'date' => ['required', 'date_format:Y-m-d'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Ошибка валидации даты',
                    'status' => 400,
                ]);
            }
            $date = date("d/m/Y", strtotime($request->date));
            $proxyService = new ValutesInfoService;
            $data = $proxyService->takeXml($date);
            /*
             * Данные должны в API поступать в realtime , в ТЗ не сказано как их возвращать - это либо сокеты , либо очередь , но я бы использовал firebase messanging
           //Larafirebase::withTitle('Котировки'.$request->date)->withBody($data)->sendMessage($request->fcm);
            */
            return response()->json([
                'data' => $data
            ]);
        }catch (\Exception $exception) {
            echo $exception;
        }
    }
}
