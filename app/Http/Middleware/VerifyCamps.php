<?php
class Verify 
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    function VerifyEmissionType($EmissionType){
    
    }
    function VerifyCorretcCombustible($combustible) {

    }
}
