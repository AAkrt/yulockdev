from flask import Flask, request

app = Flask(__name__)

authorized_players = []

@app.route("/registrar-jogador", methods=["POST"])
def registrar_jogador():
    data = request.get_json()
    nickname = data.get("nickname")

    if nickname is not None and nickname.endswith("-> Sim"):
        authorized_players.append(nickname)
        return "Jogador registrado com sucesso!", 200
    else:
        return "Acesso não autorizado.", 401

if __name__ == "__main__":
    app.run()
