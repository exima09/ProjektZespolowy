import { Prisoner } from "../prisoner/prisoner.model";

export class SickLeave {
    id?: number;
    worker;
    prisoner: Prisoner;
    reason: string;
    dateStop: Date;
    dateStart: Date;
}