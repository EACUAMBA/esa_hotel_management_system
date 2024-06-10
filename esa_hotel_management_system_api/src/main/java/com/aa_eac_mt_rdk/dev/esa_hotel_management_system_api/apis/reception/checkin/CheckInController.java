package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reception.checkin;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "reception")
public class CheckInController {
    private final CheckInService checkInService;

    @PostMapping(path = "checkin")
    public ResponseEntity<CheckInResponse> checkIn(@RequestBody CheckInRequest request) {
        return checkInService.checkIn(request);
    }
}
