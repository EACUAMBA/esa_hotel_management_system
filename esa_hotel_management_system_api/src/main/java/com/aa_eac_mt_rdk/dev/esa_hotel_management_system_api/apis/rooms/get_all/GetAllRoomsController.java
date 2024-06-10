package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_all;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "rooms")
public class GetAllRoomsController {
    private final GetAllRoomsService getAllRoomsService;

    @GetMapping
    public ResponseEntity<List<GetAllRoomsResponse>> getAllRooms() {
        return getAllRoomsService.getAllRooms();
    }
}
