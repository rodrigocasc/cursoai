import { Model } from "./Model"

export class User extends Model {
    public id?: number
    public full_name?: string
    public is_administrator?: number | number
    public password?: string
    public email?: string
    public login?: string
    public birth?: string
    public phone?: string
    public address?: string
    public cep?: string
    public city?: string
    public district?: string
    public state?: string
}