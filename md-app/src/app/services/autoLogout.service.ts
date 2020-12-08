import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

// param min
const minLogout = 7;
const checkInterval = 5000;
const storeKey = 'lastAction';

@Injectable({
    providedIn: 'root',
})
export class AutoLogoutService {
    val: any;

    constructor(
        private router: Router,
        private ngbModal: NgbModal
    ) {
        this.checkTime();
        this.initListener();
        this.initInterval();
        localStorage.setItem(storeKey, Date.now().toString());
    }

    // lecture action
    public getLastAction() {
        return parseInt(localStorage.getItem(storeKey));
    }

    public setLastAction(lastAction: number) {
        localStorage.setItem(storeKey, lastAction.toString());
    }

    reset() {
        //
        this.setLastAction(Date.now());
        //
    }

    // setINterval
    initInterval() {
        setInterval(() => {
            this.checkTime();
        }, checkInterval);
    }

    // calcul time
    checkTime() {
        const dateNow = Date.now();
        const timeLeft = this.getLastAction() + minLogout * 60 * 1000;
        const diff = timeLeft - dateNow;
        // 
        const isTimeout = diff < 0;

        if (isTimeout) {
            this.ngbModal.dismissAll()
            localStorage.clear()
            this.router.navigate([''])
        }
    }

    // identificaiton event
    storageEvt() {
        
        this.val = localStorage.getItem(storeKey);
    }

    // listener JS
    initListener() {
        document.body.addEventListener('click', () => this.reset());
        document.body.addEventListener('mouseover', () => this.reset());
        document.body.addEventListener('mouseout', () => this.reset());
        document.body.addEventListener('keydown', () => this.reset());
        document.body.addEventListener('keyup', () => this.reset());
        document.body.addEventListener('keypress', () => this.reset());
        window.addEventListener('storage', () => this.storageEvt());
    }
}
